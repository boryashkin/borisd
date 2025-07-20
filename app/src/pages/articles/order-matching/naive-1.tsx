import Layout, { SEO } from "../../../templates/layout"
import { PageMetadata } from "../../../models/index";
import { DataStruct, DataStructDef, DataTypeBool, DataTypeInt } from "../../../components/view/DataClass";
import { Definition } from "../../../components/view/Definition/Definition";
import { StaticDoMTable } from "../../../components/view/OrderBook";
import { DynamicOrderBook } from "../../../components/view/OrderBook/DynamicOrderBook";
import ArticleWrapper from "../../../templates/article/wrapper";
import { Link } from "gatsby";

export const metadata: PageMetadata = {
    title: 'Order matching: algorithms [1]',
    lang: "en",
    description: "I stumbled upon my bachelor thesis, where i made a trading system for virtual 'coins' at work. And i remembered how i tried to research and write up on order matching algorithms, but had no time for that. Now i have, and i'm starting...",
    date: "2025-06-06",
};

const Literature = [
    "https://en.wikipedia.org/wiki/Abstract_data_type",
    "https://en.wikipedia.org/wiki/List_(abstract_data_type)",
    "https://en.wikipedia.org/wiki/Priority_queue",
    "https://opendsa-server.cs.vt.edu/ODSA/Books/CS3/html/ListIntro.html",
]

const orderStruct: DataStructDef = {
    name: "Order",
    fields: [
        { name: "side", type: DataTypeBool, description: "true for buy (bid), false for sell (ask)" },
        { name: "price", type: DataTypeInt, description: "price in 'cents'" },
        { name: "quantity", type: DataTypeInt, description: "quantity of a good" },
        { name: "sequence", type: DataTypeInt, description: "instead of a timestamp, an increasing sequence number" },
    ],
};

export default function Page() {
    return (
        <Layout>
            <ArticleWrapper title={metadata.title} lang={metadata.lang} publishedAt={metadata.date}>
                <p className="italic text-xs font-mono mb-6">
                    {metadata.description}
                </p>
                <h2 className="text-xl mb-3">Introduction</h2>
                <div>
                    Basically, the idea of trading is - I have stock to sell (as expensive as possible), you have money and the desire to buy (as cheap as possible).
                    Trading systems make it possible, fair and efficient, using '<b>orders</b>'.
                    <br />
                    These orders are stored in an '<b>order book</b>', which maintains the current state of the market by organizing all active buy and sell orders.
                    A <i>Depth of Market (DoM)</i> view represents this order book, typically showing aggregated volumes at each price level (red/green tables).
                    <br />
                    <Definition term="Order book" description="A data structure that maintains a sorted collection of all active, unfilled limit orders for a particular financial instrument," />
                    <Definition term="Order matching" description="The process of matching buy and sell orders in a trading system, ensuring that trades are executed when prices align." />
                    And specifically for this aritcle:
                    <br />
                    <Definition term="Price-Time Priority (First-In-First-Out)" description="Orders are matched based on the best price, and among orders at the same price, the earliest one is executed first." />
                    <br />
                    Let's define the simplest "Order" data structure:
                    <br />
                    <div className="mt-5">
                        <div className="inline-block align-top mr-5 mb-5">
                            <DataStruct struct={orderStruct} />
                        </div>
                        <div className="inline-block align-top mb-5 mt-8">
                            For example, if we have the following orders:
                            <br />
                            <pre className="inline-block">{"{side: true, price: 100, quantity: 1, sequence: 0}"}</pre>
                            <br />
                            <pre className="inline-block">{"{side: false, price: 100, quantity: 1, sequence: 1}"}</pre>
                            <br />
                        </div>
                    </div>


                    They are going to be matched and executed: the quantity of one will be reduced from both orders. Before execution, order book (or its DoM) can look like this:
                    <div>
                        <StaticDoMTable
                            sellLevels={[
                                { price: 100, amount: 1 },
                            ]}
                            buyLevels={[
                                { price: 100, amount: 1 },
                            ]}
                        />
                    </div>

                    After - it's going to be empty.
                    <br />
                    <br />

                    So, in reality, the price level, where bid and ask meet (<b>market price</b>) is invisible, as orders are executed immediately there.
                    <br />
                    For example, if we have the following order book, see what happens when you place a new order (<i>push buttons</i>):
                    <div>
                    <DynamicOrderBook 
                        initialOrders={[
                            { isBid: true, price: 98, quantity: 1, sequence: 0 },
                            { isBid: true, price: 99, quantity: 1, sequence: 0 },
                            { isBid: true, price: 100, quantity: 1, sequence: 0 },
                            { isBid: false, price: 103, quantity: 1, sequence: 0 },
                            { isBid: false, price: 102, quantity: 1, sequence: 0 },
                            { isBid: false, price: 101, quantity: 1, sequence: 0 },
                        ]}
                    >
                        {({ onAddOrder }) => (
                            <div className="inline-block align-top ml-5 mt-14">
                                <button className="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-red-400 rounded shadow"
                                    onClick={() => onAddOrder({ isBid: false, price: 100, quantity: 1, sequence: 0 })}
                                >
                                    Sell 1 for 100
                                </button>
                                &nbsp; or &nbsp;
                                <button className="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-green-400 rounded shadow"
                                onClick={() => onAddOrder({ isBid: true, price: 100, quantity: 1, sequence: 0 })}
                            >
                                Buy 1 for 100
                            </button>
                            </div>
                            
                        )}
                    </DynamicOrderBook>
                    </div>
                    <hr className="my-5" />
                    
                    <h2 className="text-xl mb-3">Algorithms and Data Structures / naive</h2>

                    <p>
                        So, how do we match orders? Or how do we maintain the order book? We can start with a discussion of data structures.

                        <h3 className="font-bold mt-5">Operations we need:</h3>
                        <ul className="list list-disc ml-4 mb-5">
                            <li>Add (place) an order</li>
                            <li>Update an order</li>
                            <li>Remove an order</li>
                            <li>Look up / find<i className="text-xs">: to match the orders, we need the most cheap ask and the most expensive bid</i></li>
                        </ul>

                        Let's start with ADTs for just storing orders first:

                        <h3 className="font-bold mt-5">Suitable Abstract Data Types:</h3>
                        <ul className="list list-disc ml-4">
                            <li>List<i className="text-xs">: the most intuitive</i></li>
                            <li>Map<i className="text-xs">: what else supports updates and deletions</i></li>
                        </ul>


                    </p>


                    
                    <hr className="my-5" />

                    <h2 className="text-xl mb-3">TODO: Algorithms / for a scale</h2>
                    <p>
                        So, if we have millions of orders per second, how do we match them?
                    </p>

                    <hr className="my-5" />

                    <h2 className="text-xl mb-3">Literature I used:</h2>
                    <ul className="list list-disc ml-4">
                        {Literature.map((link, index) => (
                            <li><Link to={link}>{link}</Link></li>
                        ))}
                    </ul>
                    
                </div>
            </ArticleWrapper>
        </Layout>
    )
}

export const Head = () => (
    <SEO title={metadata.title} description={metadata.description} lang={metadata.lang} />
)

