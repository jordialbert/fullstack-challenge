import { getPortfolioAllocations } from "@/services/portfolio/portfolioClient";
import ListOfCards from "@/components/organisms/ListOfCardsComponent/listOfCards";

export default async function Page({ params }) {
    const data = await getPortfolioAllocations(params.id);

    return (
        <ListOfCards
            data={data}
            heading={`Portfolio`}
            createNewText={"Orders"}
            cardHeaderText={`Allocation`}
            href={true}
            navigateTo={`/${params.id}/orders`}
            cardFooterElement={false}
            page={"portfolio-detail"}
            dynamicId={params.id}
        />
    )
}
