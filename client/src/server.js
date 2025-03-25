// server.js
const express = require("express");
const axios = require("axios");
const cors = require("cors"); // Import cors package
const app = express();

// Use CORS middleware to allow all origins (you can restrict it to localhost:3000 if needed)
app.use(cors());

// Hardcode the API key directly
const ALPHA_VANTAGE_API_KEY = "53YAIQJC7MA3QVDO"; // Replace with your actual API key

// Define a route to fetch stock data from Alpha Vantage
app.get("/api/stock/:symbol", async (req, res) => {
  const { symbol } = req.params;

  // Validate the symbol
  if (!symbol) {
    return res.status(400).json({ message: "Stock symbol is required." });
  }

  try {
    const response = await axios.get("https://www.alphavantage.co/query", {
      params: {
        function: "TIME_SERIES_DAILY", // Using daily data
        symbol,
        apikey: ALPHA_VANTAGE_API_KEY, // Directly use the hardcoded API key
      },
    });

    // Log the full response for debugging
    console.log('Full Alpha Vantage Response:', response.data);

    // Check if data for the requested stock symbol exists
    if (response.data["Time Series (Daily)"]) {
      res.json(response.data);
    } else {
      // If no time series data is returned
      res.status(404).json({ message: "Stock data not found for the specified symbol." });
    }
  } catch (error) {
    console.error("Error:", error.message);
    res.status(500).json({ message: "Failed to fetch stock data." });
  }
});

// Define the port where the server should listen
const port = process.env.PORT || 5000;
app.listen(port, () => {
  console.log(`Server running on port ${port}`);
});
