import React, { useEffect, useState } from "react";
import axios from "axios";
import { Line } from "react-chartjs-2";
import { Chart as ChartJS, CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip, Legend } from "chart.js";

// Register necessary chart components
ChartJS.register(CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip, Legend);

const StockNews = ({ symbol }) => {
  const [stockData, setStockData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  // Fetch stock data when the symbol changes
  useEffect(() => {
    const fetchStockData = async () => {
      try {
        setLoading(true);
        const response = await axios.get(`http://localhost:5000/api/stock/${symbol}`);
        setStockData(response.data);
      } catch (err) {
        setError("Failed to fetch stock data.");
      } finally {
        setLoading(false);
      }
    };

    if (symbol) {
      fetchStockData();
    }
  }, [symbol]);

  // Render loading or error message
  if (loading) {
    return <div>Loading...</div>;
  }

  if (error) {
    return <div>{error}</div>;
  }

  // If stock data is available, render it as a chart
  const data = {
    labels: ["Open", "High", "Low", "Current"], // Labels for data points
    datasets: [
      {
        label: `Stock Price for ${symbol}`,
        data: [stockData.o, stockData.h, stockData.l, stockData.c], // Open, High, Low, Current prices
        borderColor: "rgba(75,192,192,1)",
        backgroundColor: "rgba(75,192,192,0.2)",
        fill: true
      }
    ]
  };

  return (
    <div>
      <h3>Stock Data for {symbol}</h3>
      <Line data={data} />
    </div>
  );
};

export default StockNews;
