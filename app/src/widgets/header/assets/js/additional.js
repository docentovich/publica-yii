//http://davidwalsh.name/javascript-debounce-function
function debounce(func, wait, immediate) { // TODO move too main js
    var timeout;
    return function () {
        var context = this, args = arguments;
        var later = function () {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
};

$('#search-input').on('keyup', debounce(function () {
    var $this = $(this);
    var $search_results_list = $('#search-results-list');
    $search_results_list.html('');
    if(!$this.val() || ($this.val() && ($this.val().length < 2) )){
        return;
    }
    var url = UrlManager.createUrl('/search', {keyword: $this.val()});

    $.post(url, function (data) {
        $search_results_list.html('');

        if (!data || (data && data.result === undefined)) {
            return;
        }

        var searchResult = function (result) {
            return $('<li><a href="' + result.url + '">' + result.search_text + '</a></li>');
        };

        data.result.forEach(function (result) {
            $search_results_list.append(searchResult(result));
        })
    })
}, 800));