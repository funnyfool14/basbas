<div class="col-sm-3">
    {{link_to_route(('application.accept_check'),'入部を承諾する',[$applicant->application_connect($team->id)->id],['class'=>'btn btn-block btn-outline-primary'])}}
</div> 
<div class="col-sm-3">
    {{link_to_route(('application.show'),'入部を拒否する',[$applicant->application_connect($team->id)->id],['class'=>'btn btn-block btn-outline-danger'])}}
</div>