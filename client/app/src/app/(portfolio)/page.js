import { getAllPortfolios } from "@/services/portfolio/portfolioClient";
import ListOfCards from "@/components/organisms/ListOfCardsComponent/listOfCards";

export default async function Page() {
    const data = await getAllPortfolios();

    return (
        <ListOfCards
            data={data}
            heading={"Portfolios"}
            createNewText={"Create new Portfolio"}
            cardHeaderText={"Portfolio"}
            href={true}
            cardFooterElement={true}
            cardFooterButtonText={"View details"}
            page={"portfolio-list"}
            handleClickAction={"put_portfolio"}
        />
    )
}
