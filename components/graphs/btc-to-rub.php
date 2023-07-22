
<section id="site_content" class="site_content">
    <div id="chartContainer" class="chart-container"></div>
    <h3>Dates From - To</h3>
    <label for="datepicker" class="datepicker-label">Выберите период для отрисовки графика:</label>
    <input id="datepicker" class="datepicker" />
    <button type="submit" id="submitButton" class="datapicker-submitButton">Submit</button>
    <table id="table" class="table"></table>
</section>

<script>
    
    let prices = ["1783696.0632695574", "1279279.0423557218", "1013474.2737211176", "1975742.2026407975", "1127947.4456159165"];
    let dates = ["1654041600000.0", "1654128000000.0", "1654214400000.0", "1654300800000.0", "1654387200000.0"];

    if (prices.length != dates.length) {
        alert("prices.length != dates.length");
    }

    var allData = [];

    for (var i = 0; i < prices.length; i++) {
        let date = new Date(Number(dates[i]));
        let price = Number(prices[i]);
        allData.push({ x: date, y: price });
    }

    var dataToShow = allData;

    const datepicker = new easepick.create({
        element: document.getElementById('datepicker'),
        css: [ 'https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.0/dist/index.css' ],
        plugins: ['RangePlugin'],
        RangePlugin: {
        tooltipNumber(num) {
            return num - 1;
        },
        locale: {
            one: 'day',
            other: 'days'
        }
        }
    });

    window.onload = function() {
        drawChart("PRICES BITCOIN TO RUB", "RUB", " P", "Bitcoin");
        firstTimeSetStartDateAndEndDate();
    }

    let bttn = document.getElementById("submitButton");
    bttn.onclick = function() {
        redrawChart("PRICES BITCOIN TO RUB", "RUB", " P", "Bitcoin");
        drawTable();
    }

</script>