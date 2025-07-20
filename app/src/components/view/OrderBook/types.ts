import React from "react";
import { Order } from "../../orderbook/Logic";

export interface PriceLevel {
    price: number;
    amount: number; // total quantity
}


export interface StaticOrderBookProps {
    buyLevels: PriceLevel[];
    sellLevels: PriceLevel[];
}

export interface OrderBookManipulation {
    onAddOrder: (order: Order) => void;
    onRemoveOrder: (sequence: number) => void;
    onUpdateOrder: (order: Order) => void;
}

export interface DynamicOrderBookProps {
    children?: (actions: OrderBookManipulation) => React.ReactNode;
    initialOrders: Order[]; // just a one-time default
}