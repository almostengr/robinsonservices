using System;
using NUnit.Framework;
using OpenQA.Selenium;

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
            
            System.Collections.ObjectModel.ReadOnlyCollection<IWebElement> buttonElements = 
                driver.FindElements(By.TagName("button"));
            foreach(IWebElement button in buttonElements)
            {
                if (button.Text == "Request Services")
                {
                    button.Click();
                    break;
                }
            }

            IWebElement h1Element = driver.FindElement(By.TagName("h1"));
            System.Collections.ObjectModel.ReadOnlyCollection<IWebElement> iFrameElements = driver.FindElements(By.TagName("iframe"));

            // assert
            Assert.AreEqual("Request Service", h1Element.Text);
            Assert.AreEqual(1, iFrameElements.Count);
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