/**
 * @author  Mediotype
 */
var BundleWizard = new Class.create();
BundleWizard.prototype = {
    initialize: function () {
        $$('.option-title').first().addClassName('active');
        $$('.option-content').first().removeClassName('no-display');
        bundle.validationCallback = function (elmId, result) {
            if (elmId == undefined || $(elmId) == undefined) {
                return;
            }
            var container = $(elmId).up('ul.options-list');
            var titleContainer = $($(elmId).up('dd').id + '_title');
            if (typeof container != 'undefined') {
                if (result == 'failed') {
                    container.removeClassName('validation-passed');
                    container.addClassName('validation-failed');

                    titleContainer.removeClassName('validation-passed');
                    titleContainer.addClassName('validation-failed');
                } else {
                    container.removeClassName('validation-failed');
                    container.addClassName('validation-passed');

                    titleContainer.removeClassName('validation-failed');
                    titleContainer.addClassName('validation-passed');
                }
            }
        };
    },

    nextStep: function (currentElement) {
        $(currentElement).up('dd').previous('dt').removeClassName('active');
        $(currentElement).up('dd').addClassName('no-display').removeClassName('active');

        $(currentElement).up('dd').next('dt').addClassName('active');
        $(currentElement).up('dd').next('dd').removeClassName('no-display').addClassName('active');
        return false;
    },

    previousStep: function (currentElement) {
        $(currentElement).up('dd').previous('dt').removeClassName('active');
        $(currentElement).up('dd').addClassName('no-display').removeClassName('active');

        $(currentElement).up('dd').previous('dt').previous('dt').addClassName('active');
        $(currentElement).up('dd').previous('dd').removeClassName('no-display').addClassName('active');
        return false;
    },

    configChanged: function (event, id) {
        selectElm = $(event.target);
        selectedValue = selectElm.options[selectElm.selectedIndex].value;
        $("bundle_option_container[" + id + "]").select('li').each(function (elm, index) {
            $(elm).addClassName('no-display');
        });

        $("bundle_option_container[" + id + "]").select("#option-" + selectedValue).each(function (elm, index) {
            $(elm).removeClassName('no-display');
        });

        $("bundle_option_container[" + id + "]").select('input').each(function (elm, index) {
            $(elm).checked = false;
        });

    }
};

document.observe("dom:loaded", function () {
    bWizard = new BundleWizard();
});
