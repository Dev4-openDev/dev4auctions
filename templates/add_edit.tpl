{$start_form}

<div class="form_row">
   <h5><span class="field_title" style="witdh: 100px; display: block;">{$titlename}</span>
   <span class="field_input">{$input_name}</span></h5>
</div>
<div class="form_row">
   <h5><span class="field_title" style="witdh: 100px; display: block;">{$product}</span>
   <span class="field_input">{$input_product}</span></h5>
</div>
<div class="form_row">
   <h5><span class="field_title" style="witdh: 100px; display: block;">{$startdatetitle}</span>
   <span class="field_input">{html_select_date prefix=$startdateprefix time=$startdate start_year="-10" end_year="+15"} {html_select_time prefix=$startdateprefix time=$startdate}</span></h5>
</div>
<div class="form_row">
   <h5><span class="field_title" style="witdh: 100px; display: block;">{$enddatetitle}</span>
   <span class="field_input">{html_select_date prefix=$enddateprefix time=$enddate start_year="0" end_year="+15"} {html_select_time prefix=$enddateprefix time=$enddate}</span></h5>
</div>
<div class="form_row">
   <h5><span class="field_title" style="witdh: 100px; display: block;">{$title_description}</span>
   <span class="field_input">{$input_description}</span></h5>
</div>

<div class="form_row">
   <span class="field_title"></span>
   <span class="field_input">{$submit}</span>
</div>
{$end_form}