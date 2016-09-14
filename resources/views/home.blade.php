@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  
            <div id="poll">
          <form method="POST" v-on="submit: onSubmitForm" v-if="!submitted">
              <!-- User ID -->
          <input type="hidden" value="{{ Auth::user()->id }}" :value="{{ Auth::user()->id }}" name="id_user" id="id_user" v-model="Answers.user">
                <!-- GET ALL QUESTIONS -->
                  <article v-for="question in questions">
                    @{{ question.id }}) @{{ question.question }} 
                    <!-- GET ALL ANSWERS -->
                    <article v-for="answer in question.answers">

                    <div v-if="question.type=='checkbox'">
                    <input type="@{{question.type}}" v-model="Answers[question.id][answer.id][answer.answer]" name="@{{ question.id }}" id="@{{ question.id }}" value="@{{ answer.answer }}">
                      @{{ answer.answer }}
                      <br>
                   </div>
                    
                    <div v-else>
                    <input type="@{{question.type}}" v-model="Answers[question.id]" name="@{{ question.id }}" id="@{{ question.id }}" value="@{{ answer.id }}">
                      @{{ answer.answer }}
                      <span class="error" v-if="! Answers[question.id]">*</span>
                      <br>
                  </div>
                  
                      </article>

                      <hr>
                  </article>
                  
            <div class="form-group" v-if="! submitted">
            <button  class="btn btn-default" type="submit" v-on:click="SubmitForm" :disabled="errors">Submit</button>
            </div>

            <div class="alert alert-warning" v-if="error">All the Questions are mandatory!</div>
            
            </form>
            <div class="alert alert-success" v-if="submitted">Thanks!</div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
