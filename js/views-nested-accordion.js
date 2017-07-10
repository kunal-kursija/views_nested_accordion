/**
 * @file
 * JS for Nested Accordion.
 */

(function ($, Drupal, drupalSettings) {
  'use strict';

  Drupal.behaviors.views_nested_accordion = {
    attach: function(context) {
      if(drupalSettings.views_nested_accordion){

          $.each(drupalSettings.views_nested_accordion, function(id) {
            /* Our Nested Accordion Settings */
            var viewname = this.viewname;
            /* Generate Accordion Effect on Outer Header Click */
            $('.view-id-' + viewname + ' .view-grouping .view-grouping-header').click(function() {
              if($(this).hasClass("nested-accordion")) {
                /* If Accordion is Open, then Clicking on it will close the Accordion. */
                $(this).removeClass("nested-accordion");
                $(this).siblings('.view-grouping-content').slideUp();
              } else {
                /* Clicking on Header will Open the Accordion */
                $(this).addClass('nested-accordion');
                $(this).siblings('.view-grouping-content').slideDown();
                $(this).parents('.views-row').siblings('.views-row').find('.view-grouping-header').removeClass("nested-accordion");
                $(this).parents('.views-row').siblings('.views-row').find('.view-grouping-content').slideUp();
              }
            });
          });

      }
    }
  };

})(jQuery, Drupal, drupalSettings);
