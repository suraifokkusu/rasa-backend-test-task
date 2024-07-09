const API_URL = '/api';

export const checkUser = async (user_id: string) => {
  const response = await fetch(`${API_URL}/src/routes/index.php?id=${user_id}`, {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
    },
  });
  if (!response.ok) {
    throw new Error('Network response was not ok');
  }
  return response.json();
};

export const submitReview = async (user_id: string, rating: number, comment: string) => {
  const response = await fetch(`${API_URL}/src/routes/index.php`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `user_id=${user_id}&rating=${rating}&comment=${comment}`,
  });
  if (!response.ok) {
    throw new Error('Network response was not ok');
  }
  return response.json();
};
