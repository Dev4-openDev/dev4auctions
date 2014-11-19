{foreach from=$list item=entry}
	<div class="col-md-12">
		<div class="tumbnail">
			<img class="img-responsive img-circle img-center" src="{root_url}/uploads/images/products/medium/{$entry->image}">
			<div class="caption center-align-text">
				<h4>Hoogste Bod: €{$entry->bids['bprice']},-</h4>
				<p><a href="{$entry->bieden}" class="btn btn-warning" role="button">Bied</a></p>
			
				<h3>{$entry->name}</h3>
				{$entry->adesc}
			</div>
		</div>
	</div>
{/foreach}
