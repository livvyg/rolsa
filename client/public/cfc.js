function calculateFootprint() {
    let electricity = document.getElementById("electricity").value || 0;
    let gasoline = document.getElementById("gasoline").value || 0;
    let flights = document.getElementById("flights").value || 0;
    let food = document.getElementById("food").value || 0;
    let waste = document.getElementById("waste").value || 0;

  
    let electricityEmission = electricity * 0.4;
    let gasolineEmission = gasoline * 2.3;
    let flightEmission = flights * 250;
    let foodEmission = food * 3; 
    let wasteEmission = waste * 2.5; 

    let totalEmission = electricityEmission + gasolineEmission + flightEmission + foodEmission + wasteEmission;

    document.getElementById("result").innerText = `Your Carbon Footprint: ${totalEmission.toFixed(2)} kg CO₂e`;

    document.getElementById("explanation").style.display = "block";


    provideAdvice(electricity, gasoline, flights, food, waste);


    updateChart(electricityEmission, gasolineEmission, flightEmission, foodEmission, wasteEmission);
}


let ctx = document.getElementById("carbonChart").getContext("2d");
let carbonChart = new Chart(ctx, {
    type: "pie",
    data: {
        labels: ["Electricity", "Fuel", "Flights", "Food", "Waste"],
        datasets: [{
            data: [0, 0, 0, 0, 0],
            backgroundColor: ["#4CAF50", "#FF9800", "#F44336", "#2196F3", "#9C27B0"]
        }]
    }
});

function updateChart(electricity, fuel, flights, food, waste) {
    carbonChart.data.datasets[0].data = [electricity, fuel, flights, food, waste];
    carbonChart.update();
}


function provideAdvice(electricity, gasoline, flights, food, waste) {
    let adviceText = "";

    if (electricity > 200) {
        adviceText += "<p><strong>Electricity:</strong> Consider switching to energy-efficient appliances or renewable energy sources to reduce your electricity usage.</p>";
    }
    if (gasoline > 100) {
        adviceText += "<p><strong>Fuel Consumption:</strong> Try using public transportation, carpooling, or switching to an electric vehicle to cut down on fuel consumption.</p>";
    }
    if (flights > 5) {
        adviceText += "<p><strong>Flights:</strong> Consider flying less or using alternative means of transport like trains for shorter trips to reduce your carbon footprint.</p>";
    }
    if (food > 50) {
        adviceText += "<p><strong>Food:</strong> A plant-based diet can significantly lower your carbon footprint. Reducing food waste is another way to cut emissions.</p>";
    }
    if (waste > 20) {
        adviceText += "<p><strong>Waste:</strong> Reduce, reuse, and recycle. Composting organic waste can also help lower your carbon footprint.</p>";
    }

    document.getElementById("advice").innerHTML = adviceText;
    document.getElementById("adviceTitle").style.display = "block";
}
