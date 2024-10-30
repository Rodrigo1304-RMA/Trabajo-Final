import org.apache.poi.hssf.usermodel.HSSFWorkbook;
import org.apache.poi.ss.usermodel.*;
import org.apache.poi.ss.util.CellRangeAddress;
import java.io.FileOutputStream;
import java.io.IOException;
import java.sql.*;
import java.util.List;
import java.util.ArrayList;
import com.google.common.collect.ImmutableList;
import org.apache.commons.lang3.StringUtils;

public class ReporteExcel {

    public static void main(String[] args) {
        List<Producto> productos = obtenerDatosDesdeBD();
        crearExcel(productos, "reporte.xls");
    }

    public static List<Producto> obtenerDatosDesdeBD() {
        List<Producto> productos = new ArrayList<>();
        String usuario = "root";
        String contraseña = "password";
        String url = "jdbc:mysql://localhost:3306/tu_base_de_datos"; // Asegúrate de configurar tu URL

        try (Connection conn = DriverManager.getConnection(url, usuario, contraseña);
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery("SELECT nombre, apellido, dni, correo, precio, cantidad, Ventas_id, fecha, Zapatilla, talla, (precio * cantidad) AS SubTotal FROM detalle_venta INNER JOIN ventas v ON dt.Ventas_id = v.id INNER JOIN usuarios u ON v.id_usuarios = u.id INNER JOIN productos p ON dt.producto_id = p.id")) {

            while (rs.next()) {
                Producto producto = new Producto(
                    rs.getString("nombre"),
                    rs.getString("apellido"),
                    rs.getString("dni"),
                    rs.getString("correo"),
                    rs.getDouble("precio"),
                    rs.getInt("cantidad"),
                    rs.getInt("Ventas_id"),
                    rs.getString("fecha"),
                    rs.getString("Zapatilla"),
                    rs.getString("talla"),
                    rs.getDouble("SubTotal")
                );
                productos.add(producto);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return productos;
    }

    public static void crearExcel(List<Producto> productos, String nombreArchivo) {
        Workbook workbook = new HSSFWorkbook();
        Sheet sheet = workbook.createSheet("Reporte");

        Row header = sheet.createRow(0);
        ImmutableList<String> headers = ImmutableList.of("Nombre", "Apellido", "DNI", "Correo", "Precio", "Cantidad", "N Venta", "Fecha", "Zapatilla", "Talla", "SubTotal");
        for (int i = 0; i < headers.size(); i++) {
            Cell cell = header.createCell(i);
            cell.setCellValue(headers.get(i));
        }

        int rowCount = 1;
        for (Producto producto : productos) {
            Row row = sheet.createRow(rowCount++);
            row.createCell(0).setCellValue(producto.getNombre());
            row.createCell(1).setCellValue(producto.getApellido());
            row.createCell(2).setCellValue(producto.getDni());
            row.createCell(3).setCellValue(producto.getCorreo());
            row.createCell(4).setCellValue(producto.getPrecio());
            row.createCell(5).setCellValue(producto.getCantidad());
            row.createCell(6).setCellValue(producto.getVentasId());
            row.createCell(7).setCellValue(producto.getFecha());
            row.createCell(8).setCellValue(producto.getZapatilla());
            row.createCell(9).setCellValue(producto.getTalla());
            row.createCell(10).setCellValue(producto.getSubTotal());
        }

        try (FileOutputStream fos = new FileOutputStream(nombreArchivo)) {
            workbook.write(fos);
            System.out.println("Reporte creado exitosamente");
        } catch (IOException e) {
            e.printStackTrace();
        } finally {
            try {
                workbook.close();
            } catch (IOException e) {
                e.printStackTrace();
            }
        }
    }
}

class Producto {
    private String nombre, apellido, dni, correo, fecha, zapatilla, talla;
    private double precio, subTotal;
    private int cantidad, ventasId;

    public Producto(String nombre, String apellido, String dni, String correo, double precio, int cantidad, int ventasId, String fecha, String zapatilla, String talla, double subTotal) {
        this.nombre = nombre;
        this.apellido = apellido;
        this.dni = dni;
        this.correo = correo;
        this.precio = precio;
        this.cantidad = cantidad;
        this.ventasId = ventasId;
        this.fecha = fecha;
        this.zapatilla = zapatilla;
        this.talla = talla;
        this.subTotal = subTotal;
    }
    
    // Getters necesarios
    public String getNombre() { return nombre; }
    public String getApellido() { return apellido; }
    public String getDni() { return dni; }
    public String getCorreo() { return correo; }
    public double getPrecio() { return precio; }
    public int getCantidad() { return cantidad; }
    public int getVentasId() { return ventasId; }
    public String getFecha() { return fecha; }
    public String getZapatilla() { return zapatilla; }
    public String getTalla() { return talla; }
    public double getSubTotal() { return subTotal; }
}
