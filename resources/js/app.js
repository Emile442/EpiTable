require('./bootstrap');
require('./delete');
require('./jquery.seat-charts');


$(document).ready(function() {
    let conf = {
        map: [
            'a[,EL]aac',
            'a__c',
            'aaca'
        ],
        seats: {
            a: {
                price   : 99.99,
                classes : 'front-seat' //your custom CSS class
            }

        },
        click: function () {
            if (this.status() == 'available') {
                //do some stuff, i.e. add to the cart
                sc.find('a.available').status('unavailable');
                return 'selected';
            } else if (this.status() == 'selected') {
                //seat has been vacated
                sc.find('a.unavailable').status('available');
                return 'available';
            } else if (this.status() == 'unavailable') {
                //seat has been already booked
                return 'unavailable';
            } else {
                return this.style();
            }
        }
    }


    let sc = $('.seat-map').seatCharts(conf);
    let sc2 = $('.seat-map2').seatCharts(conf);

    //Make all available 'c' seats unavailable
    sc.find('c.available').status('unavailable');

    // sc.get(['2_6', '1_7']).node().css({});

    console.log('Seat 1_2 costs ' + sc.get('1_2').data().price + ' and is currently ' + sc.status('1_2'));

});
