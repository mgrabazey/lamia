$(document).ready(function (){
    const api = 'http://127.0.0.1:8080/api/v1';
    const cheapVal = 200
    const cheapTax = 10
    const pageIds = {
        loading: 'loading',
        countries: 'countries',
        order: 'order',
        summary: 'summary',
    }
    const pageElems = {
        loading: $('#'+pageIds.loading),
        countries: $('#'+pageIds.countries),
        order: $('#'+pageIds.order),
        summary: $('#'+pageIds.summary),
    }
    switchPages(pageIds.loading);

    let country;
    let products;

    $.ajax({
        url: api + '/countries',
        type: 'GET',
        success: function (result) {
            countries = JSON.parse(result);
            countries.forEach(function (country) {
                $('#countries-list').append(
                    '<div class="country" data-code="'+country.code+'">'+country.name+'</div>'
                )
            });
            switchPages(pageIds.countries);
            pageElems.countries.find('.country').click(onCuontryClick)
        },
        error: onError,
    });

    function switchPages(show) {
        $('#error').text('')
        for (page in pageElems) {
            if (show === page) {
                pageElems[page].show();
            } else {
                pageElems[page].hide();
            }
        }
    }

    function onError(error) {
        console.log(error);
        $('#error').html(error.status+' '+error.statusText+'<br>'+error.responseText);
    }

    function onCuontryClick() {
        country = $(this).attr('data-code')
        $.ajax({
            url: api + '/products/' + country,
            type: 'GET',
            success: function (result) {
                products = JSON.parse(result);
                products.forEach(function (product) {
                    $('#order-list').append(
                        '<div class="product">' +
                            '<div>Name: '+product.name+'</div>' +
                            '<div>Description: '+product.description+'</div>' +
                            '<div>Base Price: '+Number(product.price).toFixed(2)+'$</div>' +
                            '<div>Country Tax: '+Number(product.tax*100).toFixed(2)+'%</div>' +
                            '<div>Total Price: '+Number(product.price*(1+product.tax)).toFixed(2)+'$</div>' +
                            'price of <input min="0" data-id="'+product.id+'" type="number" value="0"> items' +
                            ' = <span data-id="'+product.id+'">0</span>$' +
                            '<br><br>'+
                        '</div>'
                    );
                });
                switchPages(pageIds.order);
                pageElems.order.find('#order-list input').change(onProductCountChanged);
                pageElems.order.find('button').click(onOrderConfirmed);
            },
            error: onError,
        });
    }

    function onProductCountChanged() {
        elem = $(this)
        total = 0;
        products.forEach(function (product) {
            price = pageElems.order.find('#order-list span[data-id="'+product.id+'"]');
            if (elem.attr('data-id') == product.id) {
                price.text(Number(elem.val()*product.price*(1+product.tax)).toFixed(2));
            }
            total += Number(price.text());
        });
        if (total > 0 && total < cheapVal) {
            pageElems.order.find('#order-price span').text(Number(total+cheapTax).toFixed(2));
            pageElems.order.find('#order-price i').text('(with '+cheapTax+'$ fine because total products price less than '+cheapVal+'$)');

        } else {
            pageElems.order.find('#order-price span').text(Number(total).toFixed(2));
            pageElems.order.find('#order-price i').text('');
        }
    }

    function onOrderConfirmed() {
        order = {
            country_code: country,
            invoice_format: Number($('#order input[name="invoice_format"]:checked').val()),
            email: $('#order input[type="email"]').val(),
            send_to_email: $('#order input[name="send"]:checked').length > 0,
            products: {}
        }
        $('#order-list input[data-id]').each(function () {
            count = Number($(this).val());
            if (count > 0) {
                order.products[$(this).attr('data-id')] = count;
            }
        })
        $.ajax({
            url: api + '/orders',
            type: 'POST',
            data: JSON.stringify(order),
            dataType: "json",
            success: function (result) {
                html = ''
                html += '<div>order id: '+result.id+'</div>'
                result.products.forEach(function (product) {
                    html += '<div>'+
                            product.product.name+
                            ' (#'+product.count+')'+
                            ' = '+Number(product.count*product.product.price*(1+product.product.tax)).toFixed(2)+
                            '$ (with tax '+Number(product.product.tax*100).toFixed(2)+'%)'
                        '</div>'
                })
                html += '<div>total price: '+result.price+'$</div>'
                $('#summary-data').html(html)
                switchPages(pageIds.summary)
            },
            error: onError,
        });
    }
})