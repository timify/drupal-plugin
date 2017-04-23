(function (drupalSettings) {

  if (typeof drupalSettings.timify_widget !== 'undefined' &&
      typeof drupalSettings.timify_widget.id !== 'undefined' &&
      drupalSettings.timify_widget.id != null) {

    var script = document.createElement("script");
    script.src = "https://widget.timify.com/js/widget.js";
    script.setAttribute("async", "");
    script.setAttribute("id", "timify");

    if (typeof drupalSettings.timify_widget.position !== 'undefined' &&
        (drupalSettings.timify_widget.position == 'left' || drupalSettings.timify_widget.position == 'right')) {

      script.setAttribute("data-id", drupalSettings.timify_widget.id);
    }

    script.setAttribute("data-lang", drupalSettings.timify_widget.language);
    script.setAttribute("data-position", (drupalSettings.timify_widget.position == 'left' || drupalSettings.timify_widget.position == 'right' ?
                                          drupalSettings.timify_widget.position : 'multiple'));

    document.getElementsByTagName("body")[0].appendChild(script);
  }

})(drupalSettings);
