//http://davidwalsh.name/javascript-debounce-function
function debounce(func, wait, immediate) { // TODO move ti main js
    var timeout;
    // todo minimum 3-5 symbols
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
    var url = UrlManager.createUrl('/search', {keyword: $this.val()});
    $.post(url, function (data) {
        debugger;
        if (!data || (data && data.result === undefined)) {
            return;
        }

        var searchResult = function (result) {
            var url = UrlManager.createUrl('project/front/<action>', {action: 'post', id: result.id});
            return $('<li><a href="' + url + '">' + result.post_data.title + '</a></li>');
        };
        var $search_results_list = $('#search-results-list');

        data.result.forEach(function (result) {
            $search_results_list.append(searchResult(result));
        })
    })
}, 500));