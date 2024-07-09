import React, { useState, useEffect } from 'react';
import ReactStars from 'react-stars';
import { checkUser, submitReview } from '../api';
import './RatingForm.css';

const RatingForm: React.FC = () => {
  const [rating, setRating] = useState<number>(1);
  const [comment, setComment] = useState<string>('');
  const [message, setMessage] = useState<string>('');
  const [userId, setUserId] = useState<string | null>(null);
  const [isUserValid, setIsUserValid] = useState<boolean>(false);
  const [loading, setLoading] = useState<boolean>(true);

  useEffect(() => {
    const user_id = new URLSearchParams(window.location.search).get('id');
    setUserId(user_id);

    if (user_id) {
      checkUser(user_id)
        .then(result => {
          if (result.status === 'success') {
            setIsUserValid(true);
          } else {
            setIsUserValid(false);
            setMessage(result.message || 'Ссылка на голосование недоступна, свяжитесь с нами по телефону');
          }
        })
        .catch(() => setMessage('Error fetching user data'))
        .finally(() => setLoading(false));
    } else {
      setLoading(false);
      setIsUserValid(false);
      setMessage('Ссылка на голосование недоступна, свяжитесь с нами по телефону');
    }
  }, []);

  const handleSubmit = async (event: React.FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    setMessage('');

    if (rating < 1 || rating > 5) {
      setMessage('Rating must be between 1 and 5.');
      return;
    }

    if (comment.length > 500) {
      setMessage('Comment must be less than 500 characters.');
      return;
    }

    try {
      const result = await submitReview(userId!, rating, comment);
      setMessage(result.message);
    } catch {
      setMessage('Error submitting review');
    }
  };

  if (loading) {
    return <div className="centered-message">Загрузка...</div>;
  }

  if (!isUserValid) {
    return <div className="centered-message">{message}</div>;
  }

  return (
    <div className="container">
      <form onSubmit={handleSubmit} className="form">
        <h2>Оцените качество обслуживания</h2>
        <div className="rating-container">
          <ReactStars 
            count={5}
            value={rating}
            onChange={(newRating: number) => setRating(newRating)}
            size={24}
            color2={'#ffd700'} 
            half={false} 
          />
        </div>
        <label htmlFor="comment">Комментарий (не обязательно):</label>
        <textarea 
          name="comment" 
          id="comment" 
          rows={4} 
          cols={50} 
          value={comment} 
          onChange={(e: React.ChangeEvent<HTMLTextAreaElement>) => setComment(e.target.value)}
        ></textarea>
        <input type="submit" value="Отправить отзыв" />
      </form>
      <div className="message-container">
        {message && <div className="message">{message}</div>}
      </div>
    </div>
  );
};

export default RatingForm;
