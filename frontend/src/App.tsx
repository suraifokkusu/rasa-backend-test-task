import React, { useEffect, useState } from 'react';
import RatingForm from './components/RatingForm';
import axios from 'axios';

const App: React.FC = () => {
  return (
    <div className="App">
      <RatingForm />
    </div>
  );
};
export default App;
