(function ($) {

    "use strict";

    // Configura o calendário com a data atual
    $(document).ready(function () {
        var date = new Date();
        var today = date.getDate();
        // Definir manipuladores de clique para elementos DOM
        $(".right-button").click({
            date: date
        }, next_year);
        $(".left-button").click({
            date: date
        }, prev_year);
        $(".month").click({
            date: date
        }, month_click);
        $("#add-button").click({
            date: date
        }, new_event);
        // Define o mês atual como ativo
        $(".months-row").children().eq(date.getMonth()).addClass("active-month");
        init_calendar(date);
        var events = check_events(today, date.getMonth() + 1, date.getFullYear());
        show_events(events, months[date.getMonth()], today);
    });

    // Inicializa o calendário anexando as datas HTML
    function init_calendar(date) {
        $(".tbody").empty();
        $(".events-container").empty();
        var calendar_days = $(".tbody");
        var month = date.getMonth();
        var year = date.getFullYear();
        var day_count = days_in_month(month, year);
        var row = $("<tr class='table-row'></tr>");
        var today = date.getDate();
        // Defina a data como 1 para encontrar o primeiro dia do mês
        date.setDate(1);
        var first_day = date.getDay();

        // 35+firstDay é o número de elementos de data a serem adicionados à tabela de datas
        // 35 é de (7 dias em uma semana) * (até 5 linhas de datas em um mês)
        for (var i = 0; i < 35 + first_day; i++) {
            // Como alguns dos elementos estarão em branco,
            // precisa calcular a data real do índice
            var day = i - first_day + 1;
            // Se for domingo, cria uma nova linha
            if (i % 7 === 0) {
                calendar_days.append(row);
                row = $("<tr class='table-row'></tr>");
            }
            // se o índice atual não for um dia deste mês, deixe em branco
            if (i < first_day || day > day_count) {
                var curr_date = $("<td class='table-date nil'>" + "</td>");
                row.append(curr_date);
            } else {
                var curr_date = $("<td class='table-date'>" + day + "</td>");
                var events = check_events(day, month + 1, year);
                if (today === day && $(".active-date").length === 0) {
                    curr_date.addClass("active-date");
                    show_events(events, months[month], day);
                }
                // Se esta data tiver algum evento, estilize-a com .event-date
                if (events.length !== 0) {
                    curr_date.addClass("event-date");
                }

                // Configura o manipulador onClick para clicar em uma data
                curr_date.click({
                    events: events,
                    month: months[month],
                    day: day
                }, date_click);
                row.append(curr_date);
            }
        }
        // Anexa a última linha e define o ano atual
        calendar_days.append(row);
        $(".year").text(year);
    }

    // Obtém o número de dias em um determinado mês/ano
    function days_in_month(month, year) {
        var monthStart = new Date(year, month, 1);
        var monthEnd = new Date(year, month + 1, 1);
        return (monthEnd - monthStart) / (1000 * 60 * 60 * 24);
    }

    // Manipulador de eventos para quando uma data é clicada
    function date_click(event) {
        $(".events-container").show(250);
        $("#dialog").hide(250);
        $(".active-date").removeClass("active-date");
        $(this).addClass("active-date");
        show_events(event.data.events, event.data.month, event.data.day);
    };

    // Manipulador de eventos para quando um mês é clicado
    function month_click(event) {
        $(".events-container").show(250);
        $("#dialog").hide(250);
        var date = event.data.date;
        $(".active-month").removeClass("active-month");
        $(this).addClass("active-month");
        var new_month = $(".month").index(this);
        date.setMonth(new_month);
        init_calendar(date);
    }

    // Manipulador de eventos para quando o botão direito do ano é clicado

    function next_year(event) {
        $("#dialog").hide(250);
        var date = event.data.date;
        var new_year = date.getFullYear() + 1;
        $("year").html(new_year);
        date.setFullYear(new_year);
        init_calendar(date);
    }

    // Manipulador de eventos para quando o botão esquerdo do ano é clicado
    function prev_year(event) {
        $("#dialog").hide(250);
        var date = event.data.date;
        var new_year = date.getFullYear() - 1;
        $("year").html(new_year);
        date.setFullYear(new_year);
        init_calendar(date);
    }

    // Manipulador de eventos para clicar no botão de novo evento
    function new_event(event) {
        // se uma data não for selecionada então não faça nada
        if ($(".active-date").length === 0)
            return;
        // remove a entrada de erro vermelho ao clicar
        $("input").click(function () {
            $(this).removeClass("error-input");
        })
        // esvazia as entradas e oculta os eventos
        $("#dialog input[type=text]").val('');
        $("#dialog input[type=number]").val('');
        $(".events-container").hide(250);
        $("#dialog").show(250);
        // Manipulador de eventos para o botão cancelar
        $("#cancel-button").click(function () {
            $("#name").removeClass("error-input");
            $("#count").removeClass("error-input");
            $("#dialog").hide(250);
            $(".events-container").show(250);
        });
        // Manipulador de eventos para o botão ok
        $("#ok-button").unbind().click({
            date: event.data.date
        }, function () {
            var date = event.data.date;
            var name = $("#name").val().trim();
            var count = parseInt($("#count").val().trim());
            var day = parseInt($(".active-date").html());

            // Validação de formulário básico
            if (name.length === 0) {
                $("#name").addClass("error-input");
            } else if (isNaN(count)) {
                $("#count").addClass("error-input");
            } else {
                $("#dialog").hide(250);
                console.log("new event");
                new_event_json(name, count, date, day);
                date.setDate(day);
                init_calendar(date);
            }
        });
    }

    // Adiciona um evento json a event_data
    function new_event_json(name, count, date, day) {
        var event = {
            "occasion": name,
            "invited_count": document.getElementById("count").value,
            "invited_count1": document.getElementById("count1").value,
            "year": date.getFullYear(),
            "month": date.getMonth() + 1,
            "day": day
        };
        event_data["events"].push(event);
    }

    // Exibe todos os eventos da data selecionada nas visualizações de cartão
    function show_events(events, month, day) {
        // Clear the dates container
        $(".events-container").empty();
        $(".events-container").show(250);
        console.log(event_data["events"]);
        // Se não houver eventos para esta data, notifique o usuário
        if (events.length === 0) {
            var event_card = $("<div class='event-card'></div>");
            var event_name = $("<div class='event-name' style='color: white;'>Nenhum agendamento para " + day + " de " + month + ".</div>");
            $(event_card).css({
                "border-left": "10px solid #FF1744"
            });
            $(event_card).append(event_name);
            $(".events-container").append(event_card);
        } else {
            // Passa e adiciona cada evento como um cartão ao container de eventos
            for (var i = 0; i < events.length; i++) {
                var event_card = $("<div class='event-card'></div>");
                var event_name = $("<div class='event-name' style='font-weight: bold; color:#000'>Serviço: " + "<span style='font-size: 16px; line-height: 1.8;font-weight: normal; color: white;'>" + events[i]["occasion"] + "</span></div>");
                var event_count = $("<div class='event-count' style='font-weight: bold; color:#000'>Horário: " + "<span style='font-size: 16px; line-height: 1.8;font-weight: normal; color: white;'> " + events[i]["invited_count"] + " ― " + events[i]["invited_count1"] + "</span></div>");
                if (events[i]["cancelled"] === true) {
                    $(event_card).css({
                        "border-left": "10px solid #FF1744"
                    });
                    event_count = $("<div class='event-cancelled'>Cancelled</div>");
                }
                $(event_card).append(event_name).append(event_count);
                $(".events-container").append(event_card);
            }
        }
    }

    // Verifica se uma data específica possui algum evento
    function check_events(day, month, year) {
        var events = [];
        for (var i = 0; i < event_data["events"].length; i++) {
            var event = event_data["events"][i];
            if (event["day"] === day &&
                event["month"] === month &&
                event["year"] === year) {
                events.push(event);
            }
        }
        return events;
    }

    // Dados fornecidos para eventos no formato JSON
    var event_data = {
        "events": [{
            "occasion": " Repeated Test Event ",
            "invited_count": 120,
            "year": 2020,
            "month": 5,
            "day": 10,
            "cancelled": true
        },
        {
            "occasion": " Repeated Test Event ",
            "invited_count": 120,
            "year": 2020,
            "month": 5,
            "day": 10,
            "cancelled": true
        },
        {
            "occasion": " Repeated Test Event ",
            "invited_count": 120,
            "year": 2020,
            "month": 5,
            "day": 10,
            "cancelled": true
        },
        {
            "occasion": " Repeated Test Event ",
            "invited_count": 120,
            "year": 2020,
            "month": 5,
            "day": 10
        },
        {
            "occasion": " Repeated Test Event ",
            "invited_count": 120,
            "year": 2020,
            "month": 5,
            "day": 10,
            "cancelled": true
        },
        {
            "occasion": " Repeated Test Event ",
            "invited_count": 120,
            "year": 2020,
            "month": 5,
            "day": 10
        },
        {
            "occasion": " Repeated Test Event ",
            "invited_count": 120,
            "year": 2020,
            "month": 5,
            "day": 10,
            "cancelled": true
        },
        {
            "occasion": " Repeated Test Event ",
            "invited_count": 120,
            "year": 2020,
            "month": 5,
            "day": 10
        },
        {
            "occasion": " Repeated Test Event ",
            "invited_count": 120,
            "year": 2020,
            "month": 5,
            "day": 10,
            "cancelled": true
        },
        {
            "occasion": " Repeated Test Event ",
            "invited_count": 120,
            "year": 2020,
            "month": 5,
            "day": 10
        },
        {
            "occasion": " Test Event",
            "invited_count": 120,
            "year": 2020,
            "month": 5,
            "day": 11
        }
        ]
    };

    const months = [
        "Janeiro",
        "Fevereiro",
        "Março",
        "Abril",
        "Maio",
        "Junho",
        "Julho",
        "Agosto",
        "Setembro",
        "Outubro",
        "Novembro",
        "Dezembro"
    ];

})(jQuery);