import SpinningDots from '@grafikart/spinning-dots-element'
import moment from 'moment'

require('./bootstrap');
require('./delete');
require('./jquery.seat-charts');
require('alpinejs')

customElements.define('spinning-dots', SpinningDots)

window.csrf_token = $('meta[name=csrf-token]').attr("content");

window.seatMaps = [];
window.seatMap = function () {
    window.seatMaps = [];
    let inputSeat = $('#seat')

    function doConf(str) {
        let tmp = str.split('#')

        return {
            map: [
                tmp[0],
                tmp[1],
            ],
            click: function () {
                if (this.status() == 'available') {
                    setAllTableToUna()
                    inputSeat.val(this.settings.id)
                    return 'selected';
                } else if (this.status() == 'selected') {
                    setAllTableToAv()
                    inputSeat.val('')
                    return 'available';
                } else if (this.status() == 'unavailable') {
                    //seat has been already booked
                    return 'unavailable';
                } else {
                    return this.style();
                }
            }
        }
    }

    let tables = $("[id^=seat-map-]")

    tables.each((_, item) => {
        let obj = $('#' + item.id)
        let tmpSeatMap = obj.seatCharts(doConf(obj.data('map')))
        tmpSeatMap.find('c.available').status('unavailable');
        window.seatMaps.push(tmpSeatMap)
    })

    function setAllTableToUna() {
        window.seatMaps.forEach(item => {
            item.find('a.available').status('unavailable')
        })
    }

    function setAllTableToAv() {
        window.seatMaps.forEach(item => {
            item.find('a.unavailable').status('available')
        })
    }
}
window.bookingForm = function () {
    return {
        step: 1,
        tables: [],
        booking: null,
        fetchTable() {
            if (this.step !== 2)
                return;
            let tables = $('#tables_all');
            tables.html('<input type="hidden" name="place" id="seat">')

            let day = $('#day').val()
            let slot = $('#slots').val()

            axios.get('/tables/json', {params: {slot: slot, date: day}}).then(response => {
                response.data.forEach((item, index) => {
                    tables.append(`<div class="col-span-3 sm:col-span-3 md:col-span-3 xl:col-span-1"><span>${item.name}</span><div id="seat-map-${index}" data-map="${item.map}"></div></div>`)
                })
                seatMap()
            });
        },
        postForm() {
            let day = $('#day').val()
            let slot = $('#slots').val()
            let seat = $('#seat').val()

            axios.post('/bookings', {day: day, slots: slot, place: seat, _token: csrf_token}).then(function (response) {
                let booking = response.data
                let title = $('#form-success-title')
                title.addClass('text-green-500')
                title.text("Réservation validée !")
                $('#form-success-text').html(`Merci de votre réservation ! Vous êtes à la table <strong>${booking.table.name}</strong>, place n°<strong>${booking.table_place}</strong>. Cette resévation est valable le <strong>${dateToText(booking.booked_for)}</strong> pour <strong>${timeToText(booking.slot.start_at)}</strong>`)
                $('#form-success-img').html('<svg class="mb-4 h-20 w-20 text-green-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>')
            }).catch(function (error) {
                let title = $('#form-success-title')
                title.addClass('text-red-500')
                title.text("Erreur lors de la réservation !")
                $('#form-success-text').html(error.response.data.message)
                $('#form-success-img').html('')
            });
        }
    }
}
window.randomPlace = function (mode) {
    let day = $('#day').val()
    let slot = $('#slots').val()

    seatMaps.forEach(item => {
        $('#seat').val('')
        item.find('a.selected').status('available')
        item.find('a.unavailable').status('available')
    })

    axios.get('/bookings/random', {params: {day: day, slot: slot, mode: mode}}).then(response => {
        let data = response.data.seat
        let seat = data.slice('_');
        let table = parseInt(seat[0])

        $('#seat').val(data)
        seatMaps.forEach(item => {
            item.find('a.selected').status('available')
            item.find('a.available').status('unavailable')
            if (item.seatIds[0] === (seat[0] + '_1')) {
                item.seats[data].status('selected')
            }
        })
    }).catch(function (error) {
        let error_message = $('#error-message');
        error_message.html(`<div class="bg-red-100 border-l-4 border-red-500 text-red-600 p-4 mt-4 my-5" role="alert"><p><strong>Erreur: </strong>${error.response.data.message}</p></div>`)
    });
}

window.dateToText = function (dateStr) {
    let dateObj = new Date(dateStr)
    let momentObj = moment(dateObj)

    return momentObj.format('DD/MM/YYYY')
}
window.timeToText = function (timeStr) {
    let dateObj = new Date(timeStr)
    let momentObj = moment(dateObj)

    return momentObj.format('H:mm')
}
