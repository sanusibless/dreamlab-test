import React from 'react';

export default function FormErrorInput({ message }) {
    return (
        <small className="text-danger text-sm">{ message }</small>
    )
 }
