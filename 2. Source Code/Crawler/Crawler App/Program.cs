using System;
using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading.Tasks;
using System.Windows;
using System.IO;



namespace ConsoleApp1
{
    class Program
    {

        static HttpClient httpClient;
        static HttpClientHandler handler;
        static CookieContainer cookie = new CookieContainer();
        static string[] ListMenuLinksCat = new string[22];
        static string[] ListMenuLinksDog = new string[18];
        public static System.IO.FileStream fs = new System.IO.FileStream
(@"C:\Users\PHANTHĂNGLỘC\Desktop\CrawData.txt", FileMode.Append, FileAccess.Write, FileShare.None);
        public static StreamWriter sw = new StreamWriter(fs);

        static void Main(string[] args)
        {


            string uri = "https://petthings.vn/";
            IniHttpClient();
            string url = "/thuc-an-kho-cho-meo?";
            //CrawlLinks(uri);

            //for (int i = 0; i < ListMenuLinksCat.Length; i++)
            //{

            int a = 0;
            CountPageinUrl(uri, url, ref a);
            for (int j = 1; j <= a; j++)
            {
                CrawProduct(uri, url, j);
            }

            //}


            //for (int i = 0; i < ListMenuLinksDog.Length; i++)
            //{

            //    int a = 0;
            //    CountPageinUrl(uri, ListMenuLinksDog[i], ref a);
            //    for (int j = 1; j <= a; j++)
            //    {
            //        CrawProduct(uri, ListMenuLinksDog[i], j);
            //    }

            //}

            sw.Flush();
            sw.Close();
            fs.Close();

        }
        static void IniHttpClient()
        {
            handler = new HttpClientHandler
            {
                CookieContainer = cookie,
                ClientCertificateOptions = ClientCertificateOption.Automatic,
                AutomaticDecompression = DecompressionMethods.GZip | DecompressionMethods.Deflate,
                AllowAutoRedirect = true,
                UseDefaultCredentials = false
            };

            httpClient = new HttpClient(handler);

            httpClient.BaseAddress = new Uri("https://petthings.vn/");
        }
        static string CrawlDataFromURL(string url)
        {
            string html = "";

            html = WebUtility.HtmlDecode(httpClient.GetStringAsync(url).Result);
            byte[] bytes = System.Text.Encoding.UTF8.GetBytes(html);
            html = System.Text.Encoding.UTF8.GetString(bytes);
            Console.OutputEncoding = System.Text.Encoding.UTF8;

            return html;
        }

        static void CrawlLinks(string url)
        {
            string html = CrawlDataFromURL(url);
            var MenuMainList = Regex.Matches(html, @"(normal sub menu)(.*?)(end normal sub menu)"
        , RegexOptions.Singleline);
            int o = 0;
            foreach (var Menu in MenuMainList)
            {
                if (o == 0)
                {
                    var ListLinkCats = Regex.Matches(Menu.ToString(), @"href(.*?)>", RegexOptions.Singleline);
                    o++;
                    int x = 0;
                    foreach (var Menu0 in ListLinkCats)
                    {
                        int i = ListMenuLinksCat.Length;
                        ListMenuLinksCat[x] = Regex.Match(Menu0.ToString(), @"/(.*?)>").Value.Replace("\"", "").Replace(">", "");
                        x++;
                        if (x == i)
                        { break; }
                    }
                }
                else
                {
                    var ListLinkDogs = Regex.Matches(Menu.ToString(), @"href(.*?)>", RegexOptions.Singleline);
                    int x = 0;
                    foreach (var Menu0 in ListLinkDogs)
                    {
                        int i = ListMenuLinksDog.Length;
                        ListMenuLinksDog[x] = Regex.Match(Menu0.ToString(), @"/(.*?)>").Value.Replace("\"", "").Replace(">", "");
                        x++;
                        if (x == i)
                        { break; }
                    }
                }
            }
        }

        static void CountPageinUrl(string url, string link, ref int a)
        {
            url = string.Concat(url, link);
            string html = CrawlDataFromURL(url);
            var b = Regex.Matches(html, @"pagination_wrapper(.*?)/ul", RegexOptions.Singleline);
            foreach (var p in b)
            {
                var c = Regex.Matches(p.ToString(), @"page=(.*?)>", RegexOptions.Singleline);
                foreach (var dem in c)
                {
                    string d = Regex.Match(dem.ToString(), @"=(.*?)""", RegexOptions.Singleline).Value.Replace("\"", "").Replace("=", "");
                    int e = int.Parse(d);
                    if (e >= a)
                    {
                        a = e;
                    }
                }
            }
        }
        static void CrawProduct(string uri, string link, int i)
        {
            string a = string.Concat("page=", i);
            string url = string.Concat(uri, link, a);
            string html = CrawlDataFromURL(url);
            string Title = "";

            var CutHtml = Regex.Match(html.ToString(), @"grid(.*?)shop\send", RegexOptions.Singleline);
            var CutHtml2 = Regex.Match(CutHtml.ToString(), @"class=""product clearfix"">(.*?)</scrip", RegexOptions.Singleline);
            var CutHtml3 = Regex.Matches(CutHtml2.ToString(), @"<h4>(.*?)"">", RegexOptions.Singleline);
            //Lấy data
            var PageTitle = Regex.Matches(html, @"page-title(.*?)</ol", RegexOptions.Singleline);
            foreach (var cde in PageTitle)
            {
                Title = Regex.Match(cde.ToString(), @"active(.*?)<", RegexOptions.Singleline).Value.Replace("active'>", "").Replace("<", "");
            }
            foreach (var abc in CutHtml3)
            {
                string LinkProduct = Regex.Match(abc.ToString(), @"""(.*?)""", RegexOptions.Singleline).Value.Replace("\"", "");
                url = string.Concat(uri, LinkProduct);
                html = CrawlDataFromURL(url);
                WriteData(html, Title);
            }
        }

        static void WriteData(string html, string Title)
        {

            //Loại,Tên,Đã đăng,Nhãn nổi bật?,Hiển thị trong danh mục,Mô tả ngắn,Mô tả,Trạng thái thuế,Còn hàng?,Cho phép đặt trước?,Bán riêng?,Cho phép đánh giá của khách hàng?,Giá bán thường,Danh mục,Hình ảnh,Vị Trí

            //ID,Loại,"Mã sản phẩm",Tên,"Đã đăng","Nhãn nổi bật?","Hiển thị trong danh mục","Mô tả ngắn","Mô tả"
            //,"Ngày bắt đầu giảm giá","Ngày kết thúc giảm giá","Trạng thái thuế",
            //"Lớp thuế","Còn hàng?",Kho,"Cho phép đặt trước?","Bán riêng?","Cân nặng (kg)","Độ dài (cm)"
            //,"Độ rộng (cm)","Chiều cao (cm)","Cho phép đánh giá của khách hàng?","Ghi chú thanh toán"
            //,"Giá khuyến mãi","Giá bán thường","Danh mục","Từ khóa","Lớp giao hàng","Hình ảnh"
            //,"Giới hạn tải xuống","Ngày hết hạn tải về",Gốc,"Các sản phẩm theo nhóm",Upsells,"Bán chéo"
            //,"URL ngoài","Nội dung nút bấm","Vị trí"

            sw.Write(","); //ID

            // Cố định, mặc định
            string loai = "simple";  //Loại
            int DaDang = 1; //Đã Đăng
            int NhanNoi = 0; //Nhãn Nổi
            string HienThiTrongThuMuc = "\"visible\""; //hiển thị trong thư mục
            string TrangThaiThue = "\"taxable\""; //Trạng Thái Thuế
            int ConHang = 1; //Còn hàng
            int ChoPhepDatTruoc = 0; //Cho phép đặt trước
            int BanRieng = 0; //Bán riêng
            int ChoPhepDanhGia = 1; // Cho phép đánh giá của khách hàng
            string DanhMuc = Title;
            DanhMuc = string.Concat("\"", DanhMuc);
            DanhMuc = string.Concat(DanhMuc, "\"");//Danh Mục, loại sản phẩm
            int ViTri = 0; // Vị Trí

            // Không mặc định
            string Ten = "";//Tên sản phẩm
            string Mota = ""; //Mô Tả
            string MotaNgan = ""; //Mô tả ngắn
            string GiaBan = ""; // Giá Bán
            string HinhAnh = ""; //Link Hình Ảnh


            loai = string.Concat("\"", loai);
            loai = string.Concat(loai, "\"");
            sw.Write(loai); //loai
            sw.Write(",");
            sw.Write(",");//"Mã sản phẩm"

            var TenSp = Regex.Matches(html, @"page_title(.*?)</h1", RegexOptions.Singleline);
            foreach (var t in TenSp)
            {
                Ten = Regex.Match(t.ToString(), @">(.*?)</h1", RegexOptions.Singleline).Value.Replace(">", "").Replace("</h1", "").Replace("<h1", "").
                    Replace("\t", "").Replace("\n", "");
            }
            Ten = string.Concat("\"", Ten);
            Ten = string.Concat(Ten, "\"");
            sw.Write(Ten);
            sw.Write(","); //Tên

            sw.Write(DaDang);
            sw.Write(","); //"Đã đăng"
            sw.Write(NhanNoi);
            sw.Write(","); //"Nhãn nổi bật?"
            sw.Write(HienThiTrongThuMuc);
            sw.Write(",");//"Hiển thị trong danh mục"

            var MoTaNganSP = Regex.Matches(html, @"cvt_summary(.*?)</div", RegexOptions.Singleline);
            MotaNgan = Regex.Match(MoTaNganSP[0].ToString(), @"cvt_summary(.*?)</div", RegexOptions.Singleline).Value.Replace("cvt_summary\">", "").
                Replace("\"", "").Replace("</div", "").Replace("\n", "").Replace("\"", "\"\"").Replace("</p>", "</p></br>")
                    .Replace("</h1>", "</h1></br>").Replace("</h2>", "</h2></br>").Replace("</h3>", "</h3></br>")
    .Replace("</h4>", "</h4></br>").Replace("</h5>", "</h5></br>").Replace("</h6>", "</h6></br>");
            MotaNgan = string.Concat("\"", MotaNgan);
            MotaNgan = string.Concat(MotaNgan, "\"");
            sw.Write(MotaNgan);
            sw.Write(","); //"Mô tả ngắn"

            var MotaDai = Regex.Matches(html, @"wrap-chitiet(.*?)<div class=""tab-content clearfix", RegexOptions.Singleline);
            Mota = Regex.Match(MotaDai[0].ToString(), @"wrap-chitiet(.*?)</div>", RegexOptions.Singleline).Value
    .Replace("wrap-chitiet\">", "").Replace("</div>", "").Replace("\"", "\"\"")
    .Replace("\n", "").Replace("</p>", "</p></br>")
    .Replace("</h1>", "</h1></br>").Replace("</h2>", "</h2></br>").Replace("</h3>", "</h3></br>")
    .Replace("</h4>", "</h4></br>").Replace("</h5>", "</h5></br>").Replace("</h6>", "</h6></br>");

            Mota = string.Concat("\"", Mota);
            Mota = string.Concat(Mota, "\"");
            sw.Write(Mota);
            sw.Write(","); //"Mô tả"

            sw.Write(","); sw.Write(","); //"Ngày bắt đầu giảm giá","Ngày kết thúc giảm giá",



            sw.Write(TrangThaiThue); //"Trạng thái thuế",
            sw.Write(","); //

            sw.Write(","); //"Lớp thuế"

            sw.Write(ConHang); // ,"Còn hàng?",
            sw.Write(","); //

            sw.Write(","); //Kho,

            sw.Write(ChoPhepDatTruoc);
            sw.Write(","); //"Cho phép đặt trước?",

            sw.Write(BanRieng);
            sw.Write(","); //"Bán riêng?"
            sw.Write(","); // "Cân nặng (kg)",
            sw.Write(","); //,"Độ dài (cm)"
            sw.Write(","); //"Độ rộng (cm)",
            sw.Write(","); //"Chiều cao (cm)",

            sw.Write(ChoPhepDanhGia);
            sw.Write(","); sw.Write(","); sw.Write(",");//"Cho phép đánh giá của khách hàng?","Ghi chú thanh toán","Giá khuyến mãi",

            var GiaBanSP = Regex.Matches(html, @"Product Single - Price(.*?)Price End", RegexOptions.Singleline);
            var Price = Regex.Matches(GiaBanSP[0].ToString(), @"<ins(.*?)</ins", RegexOptions.Singleline);
            foreach (var price in Price)
            {
                var GiaBan1 = Regex.Matches(price.ToString(), @"\d", RegexOptions.Singleline);
                foreach (var Pricefianl in GiaBan1)
                {
                    GiaBan = Regex.Match(Pricefianl.ToString(), @"\d", RegexOptions.Singleline).Value;
                    sw.Write(GiaBan);
                }
                sw.Write(","); //"Giá bán thường",
            }

            sw.Write(DanhMuc);
            sw.Write(","); // "Danh mục",

            sw.Write(","); sw.Write(",");// "Từ khóa","Lớp giao hàng",

            var imagestep1 = Regex.Matches(html, @"Gallery(.*?)End", RegexOptions.Singleline);
            var imagestep2 = Regex.Matches(imagestep1[0].ToString(), @"nopadding(.*?)script", RegexOptions.Singleline);
            var imagestep3 = Regex.Matches(imagestep2[0].ToString(), @"<img data-lazy=(.*?)\.png|<img data-lazy=(.*?)\.jpg", RegexOptions.Singleline);
            HinhAnh = Regex.Match(imagestep3[0].ToString(), @"bizweb(.*?)\.jpg|bizweb(.*?)\.png", RegexOptions.Singleline).Value
                .Replace("lazy=", "").Replace("\"", "");

            HinhAnh = string.Concat("http://", HinhAnh);
            HinhAnh = string.Concat("\"", HinhAnh);
            HinhAnh = string.Concat(HinhAnh, "\"");
            sw.Write(HinhAnh);
            sw.Write(","); //"Hình ảnh"

            sw.Write(",");  //,"Giới hạn tải xuống",
            sw.Write(","); //"Ngày hết hạn tải về",
            sw.Write(","); //Gốc,
            sw.Write(","); //"Các sản phẩm theo nhóm"
            sw.Write(",");//,Upsells,
            sw.Write(","); //"Bán chéo"
            sw.Write(","); //,"URL ngoài"
            sw.Write("\"Mua ngay đi!Trước khi!Mọi điều dần tồi tệ hơn\""); sw.Write(",");//,"Nội dung nút bấm",
            sw.WriteLine(ViTri); //,"Vị trí"

        }
    }
}
