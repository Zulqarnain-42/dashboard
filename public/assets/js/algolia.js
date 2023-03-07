(function () {
    var client = algoliasearch('227QQH6K5M', 'cff38c2d63def055e83b5cc6cd4d26f3');
    var index = client.initIndex('products');
    var enterPressed = false;
    //initialize autocomplete on search input (ID selector must match)
    autocomplete('#promotion-search-input',
        { hint: false }, {
        source: autocomplete.sources.hits(index, { hitsPerPage: 5 }),
        //value to be displayed in input control after user's suggestion selection
        displayKey: 'title',
        //hash of templates used when rendering dataset
        templates: {
            //'suggestion' templating function used to render a single suggestion
            suggestion: function (suggestion) {
                const markup = `
                        <input type="hidden" id="custId" name="custId" value="${suggestion.id}">
                        <a class="suggestions__item suggestions__product">
                            <div class="suggestions__product-image image image--type--product">
                                <div class="image__body">
                                    <img class="image__tag" src="${suggestion.thumbnail}" alt=""/>
                                </div>
                            </div>
                            <div class="suggestions__product-info">
                                <div class="suggestions__product-name">
                                    ${suggestion._highlightResult.title.value}
                                </div>
                            </div>
                            <div class="suggestions__product-price">AED ${suggestion.price}</div>
                        </a>
                    `;
                return markup;
            },
            empty: function (result) {
                return 'Sorry, we did not find any results for "' + result.query + '"';
            }
        }
    }).on('autocomplete:selected', function (event, suggestion, dataset) {
        AddDataToTable(suggestion);
    })
})();

function AddDataToTable(productdata) {

    document.getElementById("producttable").style.visibility = "visible";

    const newRowContent = `
                    <tr id="${productdata.id}" class="product">
                        <th scope="row" class="product-id">${productdata.id}</th>
                        <td class="text-start">
                            <div class="mb-2">
                                <input type="hidden" name="productid[]" value="${productdata.id}">
                                <input type="text" class="border-0 form-control bg-light" id="productName-1" value="${productdata.title}" placeholder="Product Name" required readonly/>
                            </div>
                        </td>
                        <td>
                            <input type="number" class="border-0 form-control product-price bg-light" id="productRate-1" step="0.01" placeholder="0.00" name="newprice[]" required />
                        </td>
                        <td>
                            <div class="mb-2">
                                <input type="text" class="border-0 form-control bg-light" id="productName-1" placeholder="0" name="quantity[]" required />
                            </div>
                        </td>
                        <td class="product-removal">
                            <a href="javascript:void(0)" class="btn btn-danger"><i class="mdi mdi-trash-can"></i></a>
                        </td>
                    </tr>
                    `;

    $("#promotion-table tbody").append(newRowContent);
    $('#promotion-search-input').val('');
}

