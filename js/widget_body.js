$(document).ready(function () {
    let widget_elements = $('.widget-body .tags .tag');

    for (let widgetElement of widget_elements) {
        widgetElement.setAttribute("href",`./food_searching.php?name=${widgetElement.innerText}`);
    }
})