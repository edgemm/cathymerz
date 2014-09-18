
	<table class='wp-list-table widefat fixed unite_table_items'>
		<thead>
			<tr>
				<th width='5%'>ID</th>
				<th width='40%'>Name</th>
				<th width='15%'>N. Slides</th>						
				<th width='40%'>Actions</th>					
			</tr>
		</thead>
		<tbody>
			<?php foreach($arrSliders as $slider):
				
				$id = $slider->getID();
				$showTitle = $slider->getShowTitle();
				$title = $slider->getTitle();
				$alias = $slider->getAlias();
				$shortCode = $slider->getShortcode();
				$numSlides = $slider->getNumSlides();
				
				$editLink = self::getViewUrl(RevSliderAdmin::VIEW_SLIDER,"id=$id");
				$editSlidesLink = self::getViewUrl(RevSliderAdmin::VIEW_SLIDES,"id=$id");
				
				$showTitle = UniteFunctionsRev::getHtmlLink($editLink, $showTitle);
				
			?>
				<tr>
					<td><?php echo $id?><span id="slider_title_<?php echo $id?>" class="hidden"><?php echo $title?></span></td>								
					<td><?php echo $showTitle?></td>
					<td><?php echo $numSlides?></td>
					<td>
						<a href='<?php echo $editSlidesLink ?>'>Edit Slides</a>
						<span class="hor_sap"></span>
						<a id="button_delete_<?php echo $id?>" href='javascript:void(0)' class="button-secondary button_delete_slider">Delete</a>
					</td>
				</tr>							
			<?php endforeach;?>
			
		</tbody>		 
	</table>

	<script type="text/javascript">
		jQuery(document).ready(function(){
			RevSliderAdmin.initSlidersListView();
		});
	</script>

	