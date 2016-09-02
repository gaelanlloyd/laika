// --- Instatiate FastClick.js -------------------------------------------------
jQuery(function() {
    FastClick.attach(document.body);
});

// --- Toggler handler ---------------------------------------------------------
jQuery(document).ready(function(){
  jQuery(".toggler").click(function(){
    jQuery(this).closest(".reportItem").find(".dataTable").slideToggle();
    jQuery(this).closest(".reportItem").find(".legend").slideToggle();
  });
});