// server.js
const express = require("express");
const axios = require("axios");
const app = express();

const ALPHA_VANTAGE_API_KEY = "53YAIQJC7MA3QVDO";

// Define a route to fetch stock data from Alpha Vantage
app.get("/api/stock/:symbol", async (req, res) => {
  const { symbol } = req.params;
  
  try {
    // Make the API request to Alpha Vantage
    const response = await axios.get("https://www.alphavantage.co/query", {
      params: {
        function: "TIME_SERIES_INTRADAY", // We are requesting intraday stock data
        symbol: symbol,                  // Symbol passed from the URL
        interval: "5min",                // Time interval for stock data
        apikey: ALPHA_VANTAGE_API_KEY,    // Your API key for Alpha Vantage
      }
    });

    // Check if the API returned valid data (to avoid unnecessary empty responses)
    if (response.data["Time Series (5min)"]) {
      res.json(response.data);
    } else {
      // If Alpha Vantage doesn't return expected data, send an error message
      res.status(500).json({
        message: "No data found for the symbol, or Alpha Vantage is down.",
      });
    }

  } catch (error) {
    // Log detailed error information for debugging
    console.error("Error fetching stock data:", error.response || error.message);
    
    // Send an error response with a clear message
    res.status(500).json({
      message: "Error fetching stock data from Alpha Vantage.",
      error: error.message, // Send the specific error message to help debug
    });
  }
});

// Define the port where the server should listen
const port = process.env.PORT || 5000;
app.listen(port, () => {
  console.log(`Server running on port ${port}`);
});
