
<div class="container">
   
   <div class="col-md-3"></div>
   <div class="col-md-3 biedform">
   {$start_form}
      <div class="form_row">
         <h5><span class="field_title" style="witdh: 100px; display: block;">{$title_name}</span>
         <span class="field_input">{$input_name}</span></h5>
      </div>

      <div class="form_row">
         <h5><span class="field_title" style="witdh: 100px; display: block;">{$title_email}</span>
         <span class="field_input">{$input_email}</span></h5>
      </div>

      <div class="form_row">
         <h5><span class="field_title" style="witdh: 100px; display: block;">{$title_price}</span>
         <span class="field_input">{$input_price}</span></h5>
      </div>
      {$auction_id}
      </div>
      <div class="col-md-4">
         <span class="field_input bieder">{$submit}</span>
   </div>
   {$end_form}
</div>