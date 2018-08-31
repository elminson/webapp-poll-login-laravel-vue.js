// Poll js 
// el call in home.blade.php
// File include in app.blade.php
new Vue({
	el: "#poll",

	ready: function() { 
		this.fetchQuestions();
  },
  //Set default Data
    data: {
        Answers: '',
        submitted: false,
        error: false
    },
    //Check for empty Questions the submit button will be desabled until all questions be answered 
    //and hidde warning error All the Questions are mandatory! home.blade.php
    //
    computed: {
        errors: function() {

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
		// Get All questions from the api and created 
		fetchQuestions: function () {
			//Here I used https://github.com/vuejs/vue-resource
			 this.$http.get('api/questions').then((response) => {
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
            var data = this.Answers;
            // Show Thanks Message
            this.submitted = true;
            //Send Answers
            //Here I used https://github.com/vuejs/vue-resource
            this.$http.post('api/useranswers', data);

    }
	}
});
