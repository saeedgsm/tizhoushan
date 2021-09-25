

class Paginate {

    static setPages(dataLength,perPage,pages){
        let numberOfPages = Math.ceil(dataLength / perPage);
        for (let index = 1; index <= numberOfPages; index++) {
            pages.push(index);
        }

        return pages;
    }

    static paginate(page,perPage,fields){
        let from = (page * perPage) - perPage;
        let to = (page * perPage);
        return  fields.slice(from, to);
    }

}

export default Paginate;
