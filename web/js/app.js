(function ($) {

    var App = (function () {
        // Get the div with "data-prototype" attribute
        var container = $('div#job_categories');
        // Counter of categories
        var index = container.find(':input').length;

        initCategory = function() {
            $('#add_category').click(function(e) {
                addCategory(container);

                e.preventDefault(); // Prevent # in the URL
                return false;
            });

            // Add automatically a first field
            if (index == 0) {
                addCategory(container);
            }
            else {
                // Add delete link for the other
                container.children('div').each(function() {
                    addDeleteLink($(this));
                });
            }
        }

        addCategory = function () {
            var template = container.attr('data-prototype')
                .replace(/__name__label__/g, 'Category n°' + (index+1))
                .replace(/__name__/g, index)
            ;
            
            var prototype = $(template);

            addDeleteLink(prototype);
            container.append(prototype);

            index++;
        };

        addDeleteLink = function (prototype) {
            var deleteLink = $('<a href="#" class="btn btn-danger">Delete</a>');

            prototype.append(deleteLink);
            deleteLink.click(function(e) {
                prototype.remove();

                e.preventDefault();
                return false;
            });
        };
       
        init = function () {
            if(typeof(container.val()) !== 'undefined' ) {
                initCategory();
            }
        };
        return {
            init: init
        }
    })();

    $(
        App.init
    );
})(jQuery);