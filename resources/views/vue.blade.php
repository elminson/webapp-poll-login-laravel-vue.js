@extends('layouts.appvue')

@section('content')
<div id="poll">
<span class="pull-right" v-if="showDashboard" >
    <button class="btn btn-primary" v-on:click="Logout">Logout</button></span>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
              

                <div class="panel-heading" v-if="showDashboard"><h2>Questions </h2>
                 
                </div>
            

                  
          
          <div v-if="showDashboard">
<div class="alert alert-success" v-if="submittedPoll" >You don't have any left poll!</div>
            <form method="POST" v-on="submit: onSubmitForm" v-if="!submittedPoll">
                <!-- GET ALL QUESTIONS -->
                  
                  <article v-for="question in questions">
                  <div class="col-xs-12 ">
                    @{{ question.id }}) @{{ question.question }} 
                    <!-- GET ALL ANSWERS -->
                    <article v-for="answer in question.answers">

                    <div v-if="question.type=='checkbox'">
                    <input type="@{{question.type}}" v-model="Answers[question.id][answer.id][answer.answer]" name="@{{ question.id }}" id="@{{ question.id }}" value="@{{ answer.answer }}">
                        @{{ answer.answer }}
                            
                   </div>
                    
                    <div v-else>
                    <input type="@{{question.type}}" v-model="Answers[question.id]" name="@{{ question.id }}" id="@{{ question.id }}" value="@{{ answer.id }}">
                      @{{ answer.answer }}
                      <span class="error" v-if="! Answers[question.id]">*</span>
                      <br>
                  </div>
                  
                      </article>

                    
                      </div>
                  </article>
                  
            <div class="form-group" v-if="! submitted">
            <button  class="btn btn-default" style="margin-left: 10px;" type="submit" v-on:click="SubmitForm" :disabled="errorsPoll">Submit</button>
            </div>

            <div class="alert alert-warning" v-if="error">All the Questions are mandatory!</div>
            
            </form>
            <div class="alert alert-success" v-if="submitted">Thanks!</div>
          


            </div>
          
            </div>
        </div>
    </div>

    <div class="row" v-if="!showDashboard">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="">

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input  v-model="User.email" id="email" type="email" class="form-control" name="email" value="" required="" autofocus="">

                                                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input v-model="User.password" id="password" type="password" class="form-control" name="password" required="">

                                                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                              <div class="alert alert-warning" v-if="error">@{{ errorMsg }}</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" v-on:click="Login" class="btn btn-primary">
                                    Login
                                </button>

                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
@endsection
