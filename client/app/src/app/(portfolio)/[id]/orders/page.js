import TableComponent from "@/components/organisms/tableComponent/table";
import { getPortfolioOrders } from "@/services/order/orderClient";


export default async function Page({ params }) {
    const data = await getPortfolioOrders(params.id);

    return (
        <TableComponent
            data={data}
            heading={"Orders"}
            createNewText={"Place new Order - *Not Implemented, does not work*"}
            dynamicId={params.id}
        />
    )
}
