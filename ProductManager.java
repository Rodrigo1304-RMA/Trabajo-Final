
import java.util.ArrayList;
import java.util.List;

public class ProductManager {
    private List<Product> products;

    public ProductManager() {
        products = new ArrayList<>();
    }


    public List<Product> getProducts() {
        return products;
    }


    public void addProduct(String name, double price, String description) {
        products.add(new Product(name, price, description));
    }


    public static class Product {
        private String name;
        private double price;
        private String description;

        public Product(String name, double price, String description) {
            this.name = name;
            this.price = price;
            this.description = description;
        }


        public String getName() { return name; }
        public double getPrice() { return price; }
        public String getDescription() { return description; }
    }
}
