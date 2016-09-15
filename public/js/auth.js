
new Vue({
	el: "#poll",

	ready: function() { 
          //if poll was filled in the pass just hidden form
          this.submittedPoll = localStorage.getItem('polldone');
          this.error=false;
          this.urlapi='/abilto/webapp/public/';
          if (localStorage.getItem('token')) {
            this.showDashboard=true;
            this.fetchQuestions();
        } else {
            this.loginForm=false;
        }

  },
    data: {
        User: '',
        Answers: '',
        submitted: false,
        submittedPoll: false,
        error: false,
        errorMsg: '',
        showDashboard: false,
        urlapi: '/abilto/webapp/public/'
    },

    computed: {
        //check username and password
        errors: function() {

            for (var key in this.User) {
                if ( ! this.User[key]) {
                  this.error = true;
                  this.submitted = false;
                  return true;
                }
            }

            this.error = false;
            return false;
        },
        //check all questions filled
        errorsPoll: function() {
          
            for (var key in this.questions) {
              var id= this.questions[key].id;
                if ( ! this.Answers[id]) {
                  
                  this.error = true;
                  return true;
                }
            }
            this.error = false;
            return false;
        }
    },


	methods: {

    //Login
   	Login: function (target) {
   	  target.preventDefault();

            var data = this.User;
        

      this.submitted = false;
      //IMPLEMENT BASIC AUTH AND TOKEN HEADER SECURITY 
      this.$http.post(this.urlapi+'api/login',data).then((response) => {
      
        var result=response.body;
        if(result.token){

          localStorage.setItem('id',result.id);
          localStorage.setItem('token',result.token);
          localStorage.setItem('name',result.name);
          localStorage.setItem('email',result.email);
          this.showDashboard=true;
          this.loginForm= false;
          this.submittedPoll = localStorage.getItem('polldone');
          //Redirect to reload localStorage
          location.href = this.urlapi+'vue';
        } else {
          this.errorMsg=result.error;
          this.error= true;
        }

      }, (response) => {
        // error callback
      });

    },
    //Logout
    Logout: function (target) {
      target.preventDefault();
          localStorage.setItem('id','');
          localStorage.setItem('token','');
          localStorage.setItem('name','');
          localStorage.setItem('email','');
          this.showDashboard=false;
          this.loginForm= true;
          location.href = this.urlapi;
    },

    // Get All questions from the api and created 
    fetchQuestions: function () {
      //Here I used https://github.com/vuejs/vue-resource
       this.$http.get(this.urlapi+'api/questions').then((response) => {
        this.$set('questions',response.body);
        
      }, (response) => {
        //this could be handled better
        alert('Error!');
      });
       
      },
    //Submit the user answers
    SubmitForm: function (target) {
        //disable the submit form 
          target.preventDefault();
            //Get all Answers
            this.Answers.id =localStorage.getItem('id');
            this.Answers.token =localStorage.getItem('token');
            var data = this.Answers;
            //Load questions
            this.fetchQuestions();
            // Show Thanks Message
            this.submittedPoll = true;
            //Send Answers
            //Here I used https://github.com/vuejs/vue-resource
            this.$http.post(this.urlapi+'api/useranswers', data);
            localStorage.setItem('polldone','true');


    }
	}
});
