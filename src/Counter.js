import { useState } from 'react';

export default function MyCounter() {
    const [count, setCount] = useState(0);

    function handleClickIncrement() {
        setCount(count + 1);
        if(count>5){

        }
    }

    function handleClickDecrement() {
        if(count<0){
            setCount(0);
        }
        else{

        
        setCount(count - 1);
        }
    }

    return (
        <div className='counters'>
            <button className='btn btn-primary' onClick={handleClickIncrement}>+</button>
            <p className={count>5 ? 'red':" "}>{count}</p>
            <button className='btn btn-primary' onClick={handleClickDecrement}>-</button>
        </div>
    );
}
