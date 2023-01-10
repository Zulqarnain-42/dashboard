(function() {
    var client = algoliasearch('227QQH6K5M', 'cff38c2d63def055e83b5cc6cd4d26f3');
    var index = client.initIndex('products');
    var enterPressed = false;
    //initialize autocomplete on search input (ID selector must match)
    autocomplete('#aa-search-input',
        { hint: false }, {
            source: autocomplete.sources.hits(index, { hitsPerPage: 5 }),
            //value to be displayed in input control after user's suggestion selection
            displayKey: 'title',
            //hash of templates used when rendering dataset
            templates: {
                //'suggestion' templating function used to render a single suggestion
                suggestion: function (suggestion) {
                    const markup = `
                        <a class="suggestions__item suggestions__product" href="#">
                            <div class="suggestions__product-image image image--type--product">
                                <div class="image__body">
                                    <img class="image__tag" src="https://test.fa-bt.com/${suggestion.thumbnail}" alt=""/>
                                </div>
                            </div>
                            <div class="suggestions__product-info">
                                <div class="suggestions__product-name">
                                    ${suggestion._highlightResult.title.value}
                                </div>
                            </div>
                            <div class="suggestions__product-price">$${suggestion.price}</div>
                        </a>
                    `;
                    return markup;
                },
                empty: function (result) {
                    return 'Sorry, we did not find any results for "' + result.query + '"';
                }
            }
        }).on('autocomplete:selected', function (event, suggestion, dataset) {
            window.location.href = window.location.origin + '/product/' + suggestion.slug;
            enterPressed = true;
        }).on('keyup', function(event) {
            if (event.keyCode == 13 && !enterPressed) {
                window.location.href = window.location.origin + '/search?q=' + document.getElementById('aa-search-input').value;
            }
        });
})();
