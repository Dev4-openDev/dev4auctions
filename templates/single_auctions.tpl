{foreach from=$list item=entry}
	<div class="hidden-sm col-md-4">
		<div class="tumbnail">
			<img class="img-responsive img-circle img-center" src="{root_url}/uploads/images/products/medium/{$entry->image}">
			<div class="caption center-align-text">
				<h3>{$entry->name}</h3>
				{$entry->adesc}
				<p><a href="#" class="btn btn-warning" role="button">Bied</a></p>
				<h4>Hoogste Bod: €{$entry->bids['bprice']},-</h4>
			</div>
		</div>
	</div>
{/foreach}
