import { useState, useEffect } from "react";

export default Controlledcomponent;
function Controlledcomponent(){
   
    const [formData, setFormData] = useState({
        inputId: ''
    });

    const [productData, setProductData] = useState(null);

    const fetchProductData = async () => {
        try {
            const response = await fetch(`https://dummyjson.com/products/${formData.inputId}`);
            if (!response.ok) {
                throw new Error('Failed to fetch product data');
            }
            const data = await response.json();
            setProductData(data);
        } catch (error) {
            console.error('Error fetching product data:', error.message);
            setProductData(null);
        }
    };
    
    const handleInputChange = (event) => {
        const { name, value } = event.target;
        setFormData({
            ...formData,
            [name]: value
        });
    };

    const handleSubmit = (event) => {
        event.preventDefault();
        fetchProductData();
    };

    return (
        <div className="container" style={{display:'flex',alignItems:'center',justifyContent:'center',height:'100vh'}}>
            <div className="row justify-content-center" style={{border:'1px solid black'}}>
                <div className="col-8" style={{margin:'auto',}}>
                    <form className="form-group" onSubmit={handleSubmit}>
                        <label>ID:</label>
                        <input  type="text" name="inputId" className="form-control" value={formData.inputId} onChange={handleInputChange} />
                        <button type="submit" className="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <div>
                {productData ? (
                    <div>
                        <h2>Product Data:</h2>
                        <p>Name: {productData.name}</p>
                        <p>Price: {productData.price}</p>
                        <p>Description: {productData.description}</p>
                    </div>
                ) : (
                    <p>No product data available</p>
                )}
            </div>
        </div>
    );
};
