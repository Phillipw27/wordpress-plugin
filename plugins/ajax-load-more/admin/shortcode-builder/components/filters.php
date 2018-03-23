<?php if(has_action('alm_filters_installed')){ ?>
<div class="row input filters add-on" id="alm-filters">
   <h3 class="heading"><?php _e('Filters', 'ajax-load-more'); ?></h3>
   <div class="expand-wrap">
      <div class="section-title">
		 	<p><?php _e('Enable filters with this Ajax Load More instance.', 'ajax-load-more'); ?></p>
		 </div>
      <div class="wrap">
         <div class="inner">
            <ul>
                <li>
                 <input class="alm_element" type="radio" name="filters" value="true" id="filters-true" >
                 <label for="filters-true"><?php _e('True', 'ajax-load-more'); ?></label>
                </li>
                <li>
                 <input class="alm_element" type="radio" name="filters" value="false" id="filters-false"  checked="checked">
                 <label for="filters-false"><?php _e('False', 'ajax-load-more'); ?></label>
                </li>
            </ul>
         </div>
      </div>

      <div class="clear"></div>
      
      <div class="filters_options">

         <div class="clear"></div>
         <hr>

         <div class="section-title">
            <h4><?php _e('Analytics', 'ajax-load-more'); ?> <a href="javascript:void(0)" class="fa fa-question-circle tooltip" title="<?php _e('Each time the filter is updated a pageview will be sent to Google Analytics','ajax-load-more'); ?>."></a></h4>
   		 	<p><?php _e('Send pageviews to Google Analytics', 'ajax-load-more'); ?>.</p>
   		 </div>
         <div class="wrap">
   			<div class="inner">
               <ul>
                   <li>
                    <input class="alm_element" type="radio" name="filters-analytics" value="true" id="filters-analytics-true" checked="checked">
                    <label for="filters-analytics-true"><?php _e('True', 'ajax-load-more'); ?></label>
                   </li>
                   <li>
                    <input class="alm_element" type="radio" name="filters-analytics" value="false" id="filters-analytics-false">
                    <label for="filters-analytics-false"><?php _e('False', 'ajax-load-more'); ?></label>
                   </li>
               </ul>
   			</div>
         </div>

         <div class="clear"></div>
         <hr>

         <div class="section-title">
            <h4><?php _e('Debug Mode', 'ajax-load-more'); ?></h4>
   		 	<p><?php _e('Enable debugging of the Ajax Load More filter object in the browser console', 'ajax-load-more'); ?>.</p>
   		 </div>
         <div class="wrap">
   			<div class="inner">
               <ul>
                   <li>
                    <input class="alm_element" type="radio" name="filters-debug" value="true" id="filters-debug-true">
                    <label for="filters-debug-true"><?php _e('True', 'ajax-load-more'); ?></label>
                   </li>
                   <li>
                    <input class="alm_element" type="radio" name="filters-debug" value="false" id="filters-debug-false" checked="checked">
                    <label for="filters-debug-false"><?php _e('False', 'ajax-load-more'); ?></label>
                   </li>
               </ul>
   			</div>
         </div>

      </div>

   </div>
</div>
<?php } ?>