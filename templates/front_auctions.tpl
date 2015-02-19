{foreach from=$list item=entry}
	<div class="col-sm-4 col-md-4">
		<div class="tumbnail">
			<img class="img-responsive img-circle img-center largepic" src="{root_url}/uploads/images/products/medium/{$entry->image}" data-toggle="modal" data-target="#modal{$entry->id}">

			<div class="modal fade" id="modal{$entry->id}" tabindex="-1" role="dialog" aria-labelledby="Modal{$entry->id}" aria-hidden="true">

							<div class="modal-dialog modal-lg">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							        <h4 class="modal-title" id="myModalLabel">{$entry->pname}</h4>
							      </div>
							      <div class="modal-body">
							        <img src="{root_url}/uploads/images/products/large/{$entry->image}" class="img-responsive">
							      </div>
							    </div>
							 </div>

						</div>

			<div class="caption center-align-text">
				<h3>{$entry->name}</h3>
				<h4>Hoogste Bod: €{$entry->bids['bprice']},-</h4>
				<p><a href="{$entry->bieden}" class="btn btn-warning" role="button">Bied</a>   <a href="{$entry->meerinfo}" class="btn btn-warning" role="button">Meer info</a></p>
				{$entry->adesc}				
			</div>
		</div>
	</div>
{/foreach}
