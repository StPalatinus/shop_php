function drawChart(titleText, titleY, suffix, dataName, isMobile) {
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
            text: titleText
        },
        axisX: {
            valueFormatString: "DD MMM,YY",
        },
        // axisY: {
        //     title: titleY,
        //     includeZero: false,
        //     suffix: suffix,
        //     /*stripLines: [
        //         {
        //             value: 5000,
        //             label: "50%",
        //             labelPlacement: "outside" //"inside"
        //         },
        //         {
        //             value: 10000,
        //             label: "100%",
        //             labelPlacement: "outside" //"inside"
        //         },
        //     ]*/
        // },
        legend: {
            cursor: "pointer",
            fontSize: 16,
            itemclick: toggleDataSeries
        },
        toolTip: {
            shared: true
        },
        data: [{
            name: dataName,
            type: "splineArea",
            yValueFormatString: "#0.##" + suffix,
            showInLegend: true,
            dataPoints: dataToShow
        }]
    });

    window.innerWidth <= 420 ? (() => {
        chart.options.theme = "light2";
        chart.options.axisY = {
            labelAutoFit: true,
            labelFontWeight: "bold",
            titleFontSize: 16,
            labelFontSize: 14,
            labelBackgroundColor: "white",
            prefix: "", 
            suffix: "",
            labelPlacement: "inside", 
            tickPlacement: "inside", 
            title: titleY,
            includeZero: false,
        };
    })() : (() => {
        chart.options.theme = "light1";
        chart.options.axisY = { 
            labelAutoFit: true,
            prefix: "", 
            suffix: suffix,
            labelPlacement: "outside", 
            tickPlacement: "outside", 
            title: titleY,
            includeZero: false,
        };
    })();

    chart.render();

    function toggleDataSeries(e) {
        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        } else {
            e.dataSeries.visible = true;
        }

        chart.render();
    }
}

function redrawChart(titleText, titleY, suffix, dataName) {
    
    var startDate = datepicker.getStartDate();
    var endDate = datepicker.getEndDate();

    if (startDate > endDate) {
        startDate = new Date(endDate.getTime() - 60 * 60 * 24 * 1000);
        datepicker.setStartDate(startDate);
    }

    if (startDate < allData[0].x) {
        startDate = allData[0].x;
        datepicker.setStartDate(startDate);
    }

    if (endDate > allData[allData.length - 1].x) {
        endDate = allData[allData.length - 1].x;
        datepicker.setEndDate(endDate);
    }

    if (startDate > allData[allData.length - 1].x) {
        startDate = allData[allData.length - 2].x;
        endDate = allData[allData.length - 1].x;
        datepicker.setStartDate(startDate);
        datepicker.setEndDate(endDate);
    }
  
    if (endDate < allData[0].x) {
        startDate = allData[0].x;
        endDate = allData[1].x;
        datepicker.setStartDate(startDate);
        datepicker.setEndDate(endDate);
    }

    let leftYear = startDate.getFullYear();
    let leftMonth = startDate.getMonth();
    let leftDay = startDate.getDate();
    let rightYear = endDate.getFullYear();
    let rightMonth = endDate.getMonth();
    let rightDay = endDate.getDate();
    
    var leftIndex;
    var rightIndex;

    for (var i = 0; i < allData.length; i++) {
        let year = allData[i].x.getFullYear();
        let month = allData[i].x.getMonth();
        let day = allData[i].x.getDate();

        if ((leftYear == year) && (leftMonth == month) && (leftDay == day)) {
            leftIndex = i;
        }

        if ((rightYear == year) && (rightMonth == month) && (rightDay == day)) {
            rightIndex = i;
            break;
        }
    }

    dataToShow = [];

    for (var i = leftIndex; i <= rightIndex; i++) {
        dataToShow.push(allData[i]);
    }

    drawChart(titleText, titleY, suffix, dataName);
}

function drawTable() {

    var table = document.createElement("table");
    // table.style.width = '50%';
    table.setAttribute('border', '1');
    table.setAttribute('cellspacing', '0');
    table.setAttribute('cellpadding', '5');

    table.insertRow();

    let newCellDate1 = table.rows[table.rows.length - 1].insertCell();
    newCellDate1.textContent = "Левая дата";

    let newCellPrice1 = table.rows[table.rows.length - 1].insertCell();
    newCellPrice1.textContent = "Цена";

    let newCellDate2 = table.rows[table.rows.length - 1].insertCell();
    newCellDate2.textContent = "Правая дата";

    let newCellPrice2 = table.rows[table.rows.length - 1].insertCell();
    newCellPrice2.textContent = "Цена";
    
    let newCellPercent = table.rows[table.rows.length - 1].insertCell();
    newCellPercent.textContent = "Процент";

    for (var i = 0; i < dataToShow.length - 1; i++) {

        table.insertRow();
        
        let leftDate = `${dataToShow[i].x.getDate()}.${dataToShow[i].x.getMonth() + 1}.${dataToShow[i].x.getFullYear()}`;
        let rightDate = `${dataToShow[i + 1].x.getDate()}.${dataToShow[i + 1].x.getMonth() + 1}.${dataToShow[i + 1].x.getFullYear()}`;

        let newCellDate1 = table.rows[table.rows.length - 1].insertCell();
        newCellDate1.textContent = leftDate;

        let newCellPrice1 = table.rows[table.rows.length - 1].insertCell();
        newCellPrice1.textContent = dataToShow[i].y;

        let newCellDate2 = table.rows[table.rows.length - 1].insertCell();
        newCellDate2.textContent = rightDate;

        let newCellPrice2 = table.rows[table.rows.length - 1].insertCell();
        newCellPrice2.textContent = dataToShow[i + 1].y;

        let a = dataToShow[i].y;
        let b = dataToShow[i + 1].y;
        var percent = ((b * 100) / a) - 100;
        percent = Math.round(percent * 100) / 100;
        let newCellPercent = table.rows[table.rows.length - 1].insertCell();
        newCellPercent.textContent = percent;

    }

    let el = document.getElementById("table");
    el.innerHTML = "";
    el.appendChild(table);

}

function firstTimeSetStartDateAndEndDate() {
    let startDate = allData[allData.length - 1 - 20].x;
    datepicker.setStartDate(startDate);

    let endDate = allData[allData.length - 1].x;
    datepicker.setEndDate(endDate);
}