{$tabs_start}
   {$start_general_tab}

   <table cellspacing="0" class="pagetable">
      <thead>
         <tr>
            <th>id</th>
            <th>Name</th>
            <th>Description</th>
            <th class="pageicon">Status</th>
            <th class="pageicon">&nbsp;</th>
            <th class="pageicon">&nbsp;</th>
         </tr>
      </thead>
      <tbody>
         {foreach $items as $item}
               <tr class="{$item->rowclass}">
               <td>{$item->id}</td>
               <td>{$item->title}</td>
               <td>{$item->desc}</td>
               <td>{$item->expire|cms_date_format}</td>
               <td>{$item->editlink}</td>
               <td>{$item->deletelink}</td>
            </tr>
         {/foreach}
      </tbody>
   </table>
   {$addlink}
   {$tab_end}
   {$products_tab} 
      <table cellspacing="0" class="pagetable">
         <thead>
            <tr>
               <th>id</th>
               <th>Name</th>
               <th>Description</th>
               <th class="pageicon">Status</th>
               <th class="pageicon">&nbsp;</th>
               <th class="pageicon">&nbsp;</th>
            </tr>
         </thead>
         <tbody>
            {foreach $products as $item}
                  <tr class="{$item->rowclass}">
                  <td>{$item->id}</td>
                  <td>{$item->title}</td>
                  <td>{$item->desc}</td>
                  <td>{$item->editlink}</td>
                  <td>{$item->deletelink}</td>
               </tr>
            {/foreach}
         </tbody>
      </table>
      {$addlinkproduct}
   {$tab_end}
   {$bids_tab}
         {$start_form}
            <p>{$title_auctionfilter}</p>
            <p>{$auction_id}{$submit}</p>
         {$end_form}
         <table cellspacing="0" class="pagetable">
         <thead>
            <tr>
               <th>id</th>
               <th>AuctionID</th>
               <th>Email</th>
               <th>Price</th>
               <th class="pageicon">Status</th>
               <th class="pageicon">&nbsp;</th>
               <th class="pageicon">&nbsp;</th>
            </tr>
         </thead>
         <tbody>
            {foreach $bids as $item}
                  <tr class="{$item->rowclass}">
                  <td>{$item->id}</td>
                  <td>{$item->auctionid}</td>
                  <td>{$item->email}</td>
                  <td>{$item->price}</td>
                  <td>{$item->editlink}</td>
                  <td>{$item->deletelink}</td>
               </tr>
            {/foreach}
         </tbody>
      </table>
      {$addlinkbid}
   {$tab_end}
{$tabs_end}