// App.js
import React, { useState } from "react";
import StockNews from './StockNews';  // Since it's in the 'server' folder


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
      <StockNews symbol={symbol} />
    </div>
  );
};



export default App;
