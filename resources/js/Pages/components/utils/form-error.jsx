import React from 'react';

export default function FormErrorInput({ message }) {
    return (
        <div className="text-red-600 text-sm">
            <p>{ message }</p>
        </div>
    )
 }