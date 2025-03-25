// StockInfo.js
import React, { useState, useEffect } from "react";
import axios from "axios";

const StockInfo = ({ symbol }) => {
  const [stockData, setStockData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchStockData = async () => {
      try {
        // Make a request to the backend server instead of Alpha Vantage directly
        const response = await axios.get(`/api/stock/${symbol}`);
        setStockData(response.data);
        setLoading(false);
      } catch (error) {
        console.error("Error fetching stock data:", error);
        setError("Error fetching stock data");
        setLoading(false);
      }
    };

    fetchStockData();
  }, [symbol]);

  if (loading) return <div>Loading...</div>;
  if (error) return <div>{error}</div>;

  // Assuming stock data is in 'Time Series (5min)' field for Alpha Vantage API
  const latestData = stockData["Time Series (5min)"];
  const latestTime = Object.keys(latestData)[0];
  const latestStock = latestData[latestTime];

  return (
    <div>
      <h3>Stock Info for {symbol}</h3>
      <p>Time: {latestTime}</p>
      <p>Open: {latestStock["1. open"]}</p>
      <p>High: {latestStock["2. high"]}</p>
      <p>Low: {latestStock["3. low"]}</p>
      <p>Close: {latestStock["4. close"]}</p>
      <p>Volume: {latestStock["5. volume"]}</p>
    </div>
  );
};

export default StockInfo;
