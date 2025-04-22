require("dotenv").config();
const express = require("express");
const axios = require("axios");
const cors = require("cors");
const app = express();


app.use(cors({ origin: "http://localhost:3000" }));

// Finnhub API Key
const FINNHUB_API_KEY = "cvhsg9hr01qgkck5utn0cvhsg9hr01qgkck5utng";

if (!FINNHUB_API_KEY) {
  console.error("Finnhub API key is missing!");
  process.exit(1);
}

// Endpoint to fetch stock data
app.get("/api/stock/:symbol", async (req, res) => {
  const { symbol } = req.params;

  try {
    // Fetch stock data for the given symbol
    const response = await axios.get(`https://finnhub.io/api/v1/quote`, {
      params: {
        symbol: symbol,
        token: FINNHUB_API_KEY
      }
    });

    res.json(response.data);  // Send stock data back to the frontend
  } catch (error) {
    console.error(error);
    res.status(500).json({ message: "Error fetching stock data" });
  }
});

// Start the server
const port = process.env.PORT || 5000;
app.listen(port, () => console.log(`Server running on port ${port}`));
