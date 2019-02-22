import JsPDF from "jspdf";
import "jspdf-autotable";
import DateServices from "./date-services";
import dollar from "Plugins/format-dollar.js";

let pdf = new JsPDF({
    orientation: "p",
    unit: "in",
    format: "letter"
});

export default {

    createInvoicePDF (data) {

        // PDF Content

        pdf.setFontSize(18);
        pdf.text(DateServices.getCurrentMonthAndYear() + " Invoice", 8.5 / 2, 0.5, { align: "center" });
        pdf.setFontSize(16);
        pdf.text(data.renter, 0.5, 1);
        pdf.text("Due before: " + data.dueDate, 5.5, 1);
        pdf.setLineWidth(0.02);
        pdf.line(0.5, 1.1, 8, 1.1);

        pdf.autoTable({
            startY: 1.6,
            margin: 0.5,
            tableWidth: 4,
            headStyles: { fontSize: 12 },
            bodyStyles: { fontSize: 12 },
            head: [ ["Expense", "Amount"] ],
            body: data.invoiceItems.map((invoiceItem) => {

                let result = [];
                result.push(invoiceItem.account);
                result.push(dollar.format(invoiceItem.amount));
    
                return result;

            })
            
        });

        pdf.setFontSize(14);
        pdf.text("Memo: " + data.memo, 0.5, pdf.lastAutoTable.finalY + 0.5);
        pdf.text("Total: " + dollar.format(data.totalInvoiceAmount), 0.5, pdf.lastAutoTable.finalY + 1);

        return pdf.output("blob");

    }
};