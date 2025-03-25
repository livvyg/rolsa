import React, { useState } from "react";
import StockNews from './StockNews'; // Import the StockNews component

const App = () => {
  const [symbol, setSymbol] = useState("TSLA"); // Example: Tesla stock

  return (
    <div>
      <input
        type="text"
        value={symbol}
        onChange={(e) => setSymbol(e.target.value)}
        placeholder="Enter stock symbol"
      />
      <StockNews symbol={symbol} /> {/* Pass symbol prop to StockNews */}
    </div>
  );
};

export default App;
