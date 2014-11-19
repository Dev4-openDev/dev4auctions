			{foreach from=$list item=entry}
				<div class="row blockitem">
				{if $entry->class=='links'}
					<div class="col-md-2">
						<img src="{root_url}/uploads/images/products/small/{$entry->image}" class="img-responsive img-circle largepic" data-toggle="modal" data-target="#modal{$entry->id}">
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
					</div>
					<div class="col-md-10">
					    <div class="col-md-10 {$entry->class}">
					    	<h4 class="media-heading">{$entry->name}</h4>
					    	{$entry->adesc}
					    	<h4>{$entry->pname}</h4>
					    	{$entry->pdesc}
					    </div>
					    <div class="col-md-2">
					    	<h4>Hoogste Bod: €{$entry->bids['bprice']},-</h4>
					    	<p><a href="{$entry->bieden}" class="btn btn-warning" role="button">Bieden</a></p>
					    </div>
					</div>


				{else}


					<div class="col-sm-2 hidden-md hidden-lg">
						<img src="{root_url}/uploads/images/products/small/{$entry->image}" class="img-responsive img-circle largepic" data-toggle="modal" data-target="#modals{$entry->id}">
						<div class="modal fade" id="modals{$entry->id}" tabindex="-1" role="dialog" aria-labelledby="Modal{$entry->id}" aria-hidden="true">
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
					</div>
					<div class="col-md-10">
						<div class="col-md-2 hidden-sm hidden-xs">
					    	<h4>Hoogste Bod: €{$entry->bids['bprice']},-</h4>
					    	<p><a href="{$entry->bieden}" class="btn btn-warning" role="button">Bieden</a></p>
					    </div>
					    <div class="col-md-10 hidden-md hidden-lg">
					    	<h4 class="media-heading">{$entry->name}</h4>
					    	{$entry->adesc}
					    	<h4>{$entry->pname}</h4>
					    	{$entry->pdesc}
					    </div>
					    <div class="col-md-10 {$entry->class} hidden-sm hidden-xs">
					    	<h4 class="media-heading">{$entry->name}</h4>
					    	{$entry->adesc}
					    	<h4>{$entry->pname}</h4>
					    	{$entry->pdesc}
					    </div>
					</div>
					<div class="col-md-2 hidden-sm hidden-xs">
						<img src="{root_url}/uploads/images/products/small/{$entry->image}" class="img-responsive img-circle largepic" data-toggle="modal" data-target="#modalr{$entry->id}">
						<div class="modal fade" id="modalr{$entry->id}" tabindex="-1" role="dialog" aria-labelledby="Modal{$entry->id}" aria-hidden="true">
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
					</div>

				{/if}
				</div>
			{/foreach}