using System;
using NUnit.Framework;
using OpenQA.Selenium;
using OpenQA.Selenium.Support.UI;

namespace Almostengr.RhtServicesTest
{
    public class HomePageLinksTest : BaseTest
    {
        private IWebDriver driver = null;

        [OneTimeSetUp]
        public void Setup()
        {
            driver = StartBrowser();
        }

        [Test]
        public void TestRequestServiceButton()
        {   
            // arrange

            // act
            GoHome(driver);
            driver.FindElement(By.XPath("//*[@id=\"navbarCollapse\"]/form/button")).Click();

            driver.FindElement(By.TagName("h1"));
            System.Collections.ObjectModel.ReadOnlyCollection<IWebElement> h2Elements = driver.FindElements(By.TagName("h2"));

            int counter = 0;
            foreach(var element in h2Elements)
            {
                if (element.Text == "Phone" || element.Text == "Email")
                {
                    counter++;
                }
            }

            // assert
            Assert.AreEqual(h2Elements.Count, counter);
        }

        [Test]
        public void CheckCopyrightYear()
        {
            // arrange 

            // act
            GoHome(driver);

            // assert
            Assert.IsTrue(driver.PageSource.ToUpper().Contains(string.Concat("COPYRIGHT ", DateTime.Now.Year.ToString())));
        }

        [OneTimeTearDown]
        public void OneTimeTearDown()
        {
            CloseBrowser(driver);
        }
    }
}