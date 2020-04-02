$(document).ready(function() {
    var $newsCategory = $('#newsCategory');
    var $category = $('#category');
    var new_cat = 'new_cat';

    $('#form').on('submit', function() {
        var $element = $newsCategory;
        if ($newsCategory.val() == new_cat) {
            $element = $category;
        }
        $element.attr('category', 'category_id');
    });

    $newsCategory.on('change', function() {
        $category.toggle($(this).val() == new_cat);
    });
});
