
new Vue({
	el: "#test",

	ready: function() { 
		this.fetchQuestions();
	 console.log(this.Answers);
  },
    data: {
        Answers: '',
        submitted: false,
        error: false
    },

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

		fetchQuestions: function () {
			 this.$http.get('/abilto/webapp/public/api/questions').then((response) => {
    this.$set('questions',response.body);
    

  }, (response) => {
    // error callback
  });
       
   		},
  
   		SubmitForm: function (target) {
   	  target.preventDefault();

            var data = this.Answers;
            
            this.submitted = true;
            this.$http.post('/abilto/webapp/public/api/useranswers', data);

    }
	}
});